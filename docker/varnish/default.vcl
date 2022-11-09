# Marker to tell the VCL compiler that this VCL has been adapted to the
# new 4.0 format.
vcl 4.0;

# See the VCL chapters in the Users Guide at https://www.varnish-cache.org/docs/
# and https://www.varnish-cache.org/trac/wiki/VCLExamples for more examples.

# Default backend definition. Set this to point to your content server.
backend default {
    .host = "app";
    .port = "80";
}

acl local {
    "app";
    "varnish";
    "localhost";
    # Add here your $DEFAULT_GATEWAY CIDR to allow all containers in docker network to purge
    #"172.144.0.0/24";
}

sub vcl_recv {
    if (req.http.X-Forwarded-Proto == "https" ) {
        set req.http.X-Forwarded-Port = "443";
    } else {
        set req.http.X-Forwarded-Port = "80";
    }

    # https://info.varnish-software.com/blog/varnish-cache-brotli-compression
    if (req.http.Accept-Encoding ~ "br" && req.url !~
        "\.(jpg|png|gif|zip|gz|mp3|mov|avi|mpg|mp4|swf|woff|woff2|wmf)$") {
        set req.http.X-brotli = "true";
    }

    #
    # Update this list to your backend available languages.
    #
    # The following VCL code will normalize the ‘Accept-Language’ header
    # to either “fr”, “de”, … or “en”, in this order of precedence:
    if (req.http.Accept-Language) {
        if (req.http.Accept-Language ~ "fr") {
            set req.http.Accept-Language = "fr";
        } elsif (req.http.Accept-Language ~ "de") {
            set req.http.Accept-Language = "de";
        } elsif (req.http.Accept-Language ~ "it") {
            set req.http.Accept-Language = "it";
        } elsif (req.http.Accept-Language ~ "zh") {
            set req.http.Accept-Language = "zh";
        } elsif (req.http.Accept-Language ~ "ja") {
            set req.http.Accept-Language = "ja";
        } elsif (req.http.Accept-Language ~ "es") {
            set req.http.Accept-Language = "es";
        } elsif (req.http.Accept-Language ~ "en") {
            set req.http.Accept-Language = "en";
        } else {
            # unknown language. Remove the accept-language header and
            # use the backend default.
            unset req.http.Accept-Language;
        }
    }

    # Remove has_js and Cloudflare/Google Analytics __* cookies.
    set req.http.Cookie = regsuball(req.http.Cookie, "(^|;\s*)(_[_a-z]+|has_js)=[^;]*", "");
    # Remove a ";" prefix, if present.
    set req.http.Cookie = regsub(req.http.Cookie, "^;\s*", "");

    # Happens before we check if we have this in cache already.
    #
    # Typically you clean up the request here, removing cookies you don't need,
    # rewriting the request, etc.
    if (req.url ~ "(\?|\&)_preview=") {
        return(pass);
    }
    if (req.url ~ "^/(rz-admin|preview\.php|clear_cache\.php|install\.php|dev\.php)") {
        return(pass);
    } else {
        # Remove the cookie header to enable caching
        # MAKE SURE YOU DONT HAVE USER ACCOUNT FEATURES OR NON-AJAX CONTACT FORM
        # This will prevent any SESSION based features unless you configure VARYING on cookie or ESI.
        unset req.http.cookie;
    }

    #
    # Purge one object by its URL
    #
    if (req.method == "PURGE") {
        if (client.ip ~ local) {
            return(purge);
        } else {
            return(synth(403, "Access denied."));
        }
    }

    #
    # Purge entire domain objects
    #
    if (req.method == "BAN") {
        # Same ACL check as above:
        if (client.ip ~ local) {
            if (req.http.ApiPlatform-Ban-Regex) {
                ban("obj.http.Cache-Tags ~ " + req.http.ApiPlatform-Ban-Regex);
                return (synth(200, "Ban added"));
            }
            elseif (req.http.X-Cache-Tags) {
                ban("obj.http.X-Cache-Tags ~ " + req.http.X-Cache-Tags);
                return(synth(200, "Ban using cache-tags"));
            }
            else {
                ban("req.http.host ~ " + req.http.host);
                return(synth(200, "Ban domain"));
            }
        } else {
            return(synth(403, "Access denied."));
        }
    }
}

# https://info.varnish-software.com/blog/varnish-cache-brotli-compression
sub vcl_hash {
    if (req.http.X-brotli == "true") {
        hash_data("brotli");
    }
}

# https://info.varnish-software.com/blog/varnish-cache-brotli-compression
sub vcl_backend_fetch {
    if (bereq.http.X-brotli == "true") {
        set bereq.http.Accept-Encoding = "br";
        unset bereq.http.X-brotli;
    }
}

sub vcl_backend_response {
    # Happens after we have read the response headers from the backend.
    #
    # Here you clean the response headers, removing silly Set-Cookie headers
    # and other mistakes your backend does.

    set beresp.grace = 2m;
    set beresp.keep = 8m;

    # Cache 404 for short period
    if (beresp.status == 404) {
        set beresp.ttl = 30s;
        unset beresp.http.Set-Cookie;
        return (deliver);
    }

    # Clean backend responses only on public pages.
    if (bereq.url !~ "^/(rz-admin|preview\.php|clear_cache\.php|install\.php|dev\.php)" && bereq.url !~ "(\?|\&)_preview=") {
        # Remove the cookie header to enable caching
        unset beresp.http.Set-Cookie;
    }
}

sub vcl_deliver {
    # Happens when we have all the pieces we need, and are about to send the
    # response to the client.
    #
    # You can do accounting or modifying the final object here.

    # Remove cache-tags, unless you want Cloudflare or other to see them
    unset resp.http.X-Cache-Tags;
    # Comment the following line to send the "Cache-Tags" header to the client (e.g. to use CloudFlare cache tags)
    unset resp.http.Cache-Tags;
}

