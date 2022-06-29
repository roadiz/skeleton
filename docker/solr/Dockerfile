FROM solr:8-slim
MAINTAINER Ambroise Maupate <ambroise@rezo-zero.com>

ARG USER_UID=8983

USER root
RUN set -ex; \
    echo "USER_UID: ${USER_UID}\n"; \
    usermod -u ${USER_UID} "$SOLR_USER"; \
    groupmod -g ${USER_UID} "$SOLR_GROUP"; \
    chown -R ${USER_UID}:${USER_UID} /var/solr;

COPY managed-schema.xml /opt/solr/server/solr/configsets/_default/conf/managed-schema

USER $SOLR_USER
