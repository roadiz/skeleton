FROM solr:8-slim
MAINTAINER Ambroise Maupate <ambroise@rezo-zero.com>

ARG USER_UID=1000

USER root
RUN set -ex; \
    echo "USER_UID: ${USER_UID}\n"; \
    usermod -u ${USER_UID} "$SOLR_USER"; \
    groupmod -g ${USER_UID} "$SOLR_GROUP";

COPY managed-schema.xml /opt/solr/server/solr/configsets/_default/conf/managed-schema

USER $SOLR_USER
