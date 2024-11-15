variable "REGISTRY" {
    default = "registry.xxxxx.com/group/project"
}

variable "VERSION" {
    default = ""
}

group "default" {
    targets = ["api"]
}

target "api" {
    name = "api-${item.name}"
    platforms = ["linux/amd64"]
    matrix = {
        item = [
            {
                name = "php"
                target = "php-prod"
            },
            {
                name = "nginx"
                target = "nginx-prod"
            },
            {
                name = "varnish"
                target = "varnish"
            },
            # {
            #     name = "solr"
            #     target = "solr"
            # },
        ]
    }
    context = "."
    dockerfile = "Dockerfile"
    target = item.target
    tags = [
            notequal(VERSION, "") ? "${REGISTRY}/api-${item.name}:${VERSION}" : "${REGISTRY}/api-${item.name}:develop",
            notequal(VERSION, "") ? "${REGISTRY}/api-${item.name}:latest" : "",
    ]
}
