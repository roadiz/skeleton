# Marker to tell the VCL compiler that this VCL has been adapted to the
# new 4.0 format.
vcl 4.0;

import std;

# See the VCL chapters in the Users Guide at https://www.varnish-cache.org/docs/
# and https://www.varnish-cache.org/trac/wiki/VCLExamples for more examples.

# Default backend definition. Set this to point to your content server.
backend default {
    .host = "nginx";
    .port = "80";
}

acl local {
    "localhost";
    "127.0.0.1";
    "::1";
    # Add here your $DEFAULT_GATEWAY CIDR to allow all containers in docker network to purge
    #"172.144.0.0/16";
}

sub vcl_recv {
    # https://www.varnish-software.com/developers/tutorials/example-vcl-template/#4-httpoxy-mitigation
    unset req.http.proxy;

    # https://www.varnish-software.com/developers/tutorials/example-vcl-template/#5-sorting-query-string-parameters
    set req.url = std.querysort(req.url);

    # https://www.varnish-software.com/developers/tutorials/example-vcl-template/#7-removing-marketing-parameters-from-the-query-string
    # Remove tracking query string parameters used by analytics tools
    if (req.url ~ "(\?|&)(_branch_match_id|_bta_[a-z]+|_bta_c|_bta_tid|_ga|_gl|_ke|_kx|campid|cof|customid|cx|dclid|dm_i|ef_id|epik|fbclid|gad_source|gbraid|gclid|gclsrc|gdffi|gdfms|gdftrk|hsa_acc|hsa_ad|hsa_cam|hsa_grp|hsa_kw|hsa_mt|hsa_net|hsa_src|hsa_tgt|hsa_ver|ie|igshid|irclickid|matomo_campaign|matomo_cid|matomo_content|matomo_group|matomo_keyword|matomo_medium|matomo_placement|matomo_source|mc_[a-z]+|mc_cid|mc_eid|mkcid|mkevt|mkrid|mkwid|msclkid|mtm_campaign|mtm_cid|mtm_content|mtm_group|mtm_keyword|mtm_medium|mtm_placement|mtm_source|nb_klid|ndclid|origin|pcrid|piwik_campaign|piwik_keyword|piwik_kwd|pk_campaign|pk_keyword|pk_kwd|redirect_log_mongo_id|redirect_mongo_id|rtid|s_kwcid|sb_referer_host|sccid|si|siteurl|sms_click|sms_source|sms_uph|srsltid|toolid|trk_contact|trk_module|trk_msg|trk_sid|ttclid|twclid|utm_[a-z]+|utm_campaign|utm_content|utm_creative_format|utm_id|utm_marketing_tactic|utm_medium|utm_source|utm_source_platform|utm_term|vmcid|wbraid|yclid|zanpid)=") {
        set req.url = regsuball(req.url, "(_branch_match_id|_bta_[a-z]+|_bta_c|_bta_tid|_ga|_gl|_ke|_kx|campid|cof|customid|cx|dclid|dm_i|ef_id|epik|fbclid|gad_source|gbraid|gclid|gclsrc|gdffi|gdfms|gdftrk|hsa_acc|hsa_ad|hsa_cam|hsa_grp|hsa_kw|hsa_mt|hsa_net|hsa_src|hsa_tgt|hsa_ver|ie|igshid|irclickid|matomo_campaign|matomo_cid|matomo_content|matomo_group|matomo_keyword|matomo_medium|matomo_placement|matomo_source|mc_[a-z]+|mc_cid|mc_eid|mkcid|mkevt|mkrid|mkwid|msclkid|mtm_campaign|mtm_cid|mtm_content|mtm_group|mtm_keyword|mtm_medium|mtm_placement|mtm_source|nb_klid|ndclid|origin|pcrid|piwik_campaign|piwik_keyword|piwik_kwd|pk_campaign|pk_keyword|pk_kwd|redirect_log_mongo_id|redirect_mongo_id|rtid|s_kwcid|sb_referer_host|sccid|si|siteurl|sms_click|sms_source|sms_uph|srsltid|toolid|trk_contact|trk_module|trk_msg|trk_sid|ttclid|twclid|utm_[a-z]+|utm_campaign|utm_content|utm_creative_format|utm_id|utm_marketing_tactic|utm_medium|utm_source|utm_source_platform|utm_term|vmcid|wbraid|yclid|zanpid)=[-_A-z0-9+(){}%.*]+&?", "");
        set req.url = regsub(req.url, "[?|&]+$", "");
    }

    if (req.http.X-Forwarded-Proto == "https" ) {
        set req.http.X-Forwarded-Port = "443";
    } else {
        set req.http.X-Forwarded-Port = "80";
    }

    # Exclude typically large files from caching
    if (req.url ~ "\.(dmg|exe|gz|msi|pkg|tgz|zip|pdf)$") {
        return(pass);
    }

    # Override Accept-Encoding header to unify the cache when browser
    # accepts gzip or deflate at least.
    if (req.http.Accept-Encoding ~ "gzip, deflate") {
        set req.http.Accept-Encoding = "gzip, deflate";
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

    # Some generic cookie manipulation, useful for all templates that follow
    # Remove has_js and Cloudflare/Google Analytics __* cookies.
    set req.http.Cookie = regsuball(req.http.Cookie, "(^|;\s*)(_[_a-z]+|has_js)=[^;]*", "");
    # Remove Axeptio cookies.
    set req.http.Cookie = regsuball(req.http.Cookie, "(^|;\s*)(axeptio_[_a-z]+)=[^;]*", "");
    # Remove the "has_js" cookie
    set req.http.Cookie = regsuball(req.http.Cookie, "has_js=[^;]+(; )?", "");

    # Remove any Google Analytics based cookies
    set req.http.Cookie = regsuball(req.http.Cookie, "__utm[^=]+=[^;]+(; )?", "");
    set req.http.Cookie = regsuball(req.http.Cookie, "_ga[^=]*=[^;]+(; )?", "");
    set req.http.Cookie = regsuball(req.http.Cookie, "_gcl_[^=]+=[^;]+(; )?", "");
    set req.http.Cookie = regsuball(req.http.Cookie, "_gid=[^;]+(; )?", "");

    # Remove DoubleClick offensive cookies
    set req.http.Cookie = regsuball(req.http.Cookie, "__gads=[^;]+(; )?", "");

    # Remove the Quant Capital cookies (added by some plugin, all __qca)
    set req.http.Cookie = regsuball(req.http.Cookie, "__qc.=[^;]+(; )?", "");

    # Remove the AddThis cookies
    set req.http.Cookie = regsuball(req.http.Cookie, "__atuv.=[^;]+(; )?", "");

    # Remove a ";" prefix in the cookie if present
    set req.http.Cookie = regsuball(req.http.Cookie, "^;\s*", "");

    # Are there cookies left with only spaces or that are empty?
    if (req.http.cookie ~ "^\s*$") {
        unset req.http.cookie;
    }

    # Happens before we check if we have this in cache already.
    #
    # Typically you clean up the request here, removing cookies you don't need,
    # rewriting the request, etc.
    if (req.url ~ "(\?|\&)_preview=") {
        return(pass);
    }
    if (req.url ~ "^/rz\-admin") {
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
                return (synth(200, "Ban using cache-tags"));
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
    if (bereq.url !~ "^/rz\-admin" && bereq.url !~ "(\?|\&)_preview=") {
        # Remove the cookie header to enable caching
        unset beresp.http.Set-Cookie;
    }
}

sub vcl_deliver {
    # Happens when we have all the pieces we need, and are about to send the
    # response to the client.
    #
    # You can do accounting or modifying the final object here.

    # Remove cache-tags, unless you want Cloudflare or Nuxt to see them (to use cache tags on Nuxt responses)
    # Make sure to allow CORS on Cache-Tags header if you want to use it on Nuxt.
    unset resp.http.X-Cache-Tags;
    unset resp.http.Cache-Tags;

    # We want to expose API cache-tags to the client, especially Nuxt to be able to purge frontend cache
    # But we don't want to expose cache-tags to the client on Nuxt pages
    #if (req.url !~ "^/api") {
    #    # Remove cache-tags, unless you want Cloudflare or other to see them
    #    unset resp.http.X-Cache-Tags;
    #    unset resp.http.Cache-Tags;
    #}
}

