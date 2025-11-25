-- Update admin password to '123456'
-- MD5 hash of '123456' is: e10adc3949ba59abbe56e057f20f883e

-- Method 1: UPDATE existing admin user
UPDATE user SET user_password = 'e10adc3949ba59abbe56e057f20f883e' WHERE username = 'admin';

-- Method 2: INSERT new admin user (if admin doesn't exist)
INSERT INTO user (user_id, user_email, user_mobile, user_password, username, name, type)
VALUES (1, 'admin@gmail.com', '+625455649685', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'Okri', 'admin')
ON DUPLICATE KEY UPDATE user_password = 'e10adc3949ba59abbe56e057f20f883e';

-- Check the result
SELECT user_id, username, user_email, type FROM user WHERE username = 'admin';