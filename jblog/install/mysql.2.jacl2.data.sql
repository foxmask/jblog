INSERT INTO jacl2_group (name, grouptype, ownerlogin) VALUES ('admins', 0, NULL); -- id_aclgrp = 1
INSERT INTO jacl2_group (name, grouptype, ownerlogin) VALUES ('users', 0, NULL); -- id_aclgrp = 2


INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('acl.user.view', 'jelix~acl2db.acl.user.view');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('acl.user.modify', 'jelix~acl2db.acl.user.modify');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('acl.group.modify', 'jelix~acl2db.acl.group.modify');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('acl.group.create', 'jelix~acl2db.acl.group.create');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('acl.group.delete', 'jelix~acl2db.acl.group.delete');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('acl.group.view', 'jelix~acl2db.acl.group.view');


INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('acl.group.modify', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('acl.group.create', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('acl.group.delete', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('acl.group.view', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('acl.user.modify', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('acl.user.view', 1, '');




INSERT INTO jacl2_group (id_aclgrp, name, grouptype, ownerlogin) VALUES (0, 'anonymous', 1, NULL); -- id_aclgrp = 0
INSERT INTO jacl2_group (name, grouptype, ownerlogin) VALUES ('redactors', 0, NULL); -- id_aclgrp = 3
INSERT INTO jacl2_group (name, grouptype, ownerlogin) VALUES ('moderators', 0, NULL); -- id_aclgrp = 4


INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('admin.view', 'admin~default.acl2.view');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jblog.view', 'jblog~default.acl2.view');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jarticles.list', 'jarticles~admin.acl2.list');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jarticles.read', 'jarticles~admin.acl2.read');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jarticles.create', 'jarticles~admin.acl2.create');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jarticles.update', 'jarticles~admin.acl2.update');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jarticles.delete', 'jarticles~admin.acl2.delete');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jcategories.list', 'jcategories~admin.acl2.list');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jcategories.read', 'jcategories~admin.acl2.read');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jcategories.create', 'jcategories~admin.acl2.create');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jcategories.update', 'jcategories~admin.acl2.update');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jcategories.delete', 'jcategories~admin.acl2.delete');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jcomments.list', 'jcomments~admin.acl2.list');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jcomments.read', 'jcomments~admin.acl2.read');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jcomments.create', 'jcomments~admin.acl2.create');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jcomments.update', 'jcomments~admin.acl2.update');
INSERT INTO jacl2_subject (id_aclsbj, label_key) VALUES ('jcomments.delete', 'jcomments~admin.acl2.delete');


INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jblog.view', 0, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.list', 0, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.read', 0, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.list', 0, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.read', 0, '');

INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jblog.view', 2, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.list', 2, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.read', 2, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.list', 2, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.read', 2, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.list', 2, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.read', 2, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.create', 2, '');

INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jblog.view', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('admin.view', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.list', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.read', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.create', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.update', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.delete', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.list', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.read', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.create', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.update', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.delete', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.list', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.read', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.create', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.update', 1, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.delete', 1, '');

INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jblog.view', 3, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('admin.view', 3, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.list', 3, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.read', 3, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.create', 3, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.list', 3, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.read', 3, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.list', 3, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.read', 3, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.create', 3, '');

INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jblog.view', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('admin.view', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.list', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.read', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.create', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.update', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jarticles.delete', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.list', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcategories.read', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.list', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.read', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.create', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.update', 4, '');
INSERT INTO jacl2_rights (id_aclsbj, id_aclgrp, id_aclres) VALUES ('jcomments.delete', 4, '');
