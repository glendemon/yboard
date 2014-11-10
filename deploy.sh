#!/bin/bash
tar --transform='s,^,yboard/,s'  \
--exclude ".hg*" \
--exclude nbproject \
--exclude deploy.sh \
--exclude "yboard.rev*.tar.gz" \
-czf yboard.rev`hg log --rev . --template "{rev}"`.tar.gz * .htaccess