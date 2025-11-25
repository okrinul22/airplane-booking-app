/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50733 (5.7.33)
 Source Host           : localhost:3306
 Source Schema         : travel

 Target Server Type    : MySQL
 Target Server Version : 50733 (5.7.33)
 File Encoding         : 65001

 Date: 12/12/2023 18:31:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for air_plane
-- ----------------------------
DROP TABLE IF EXISTS `air_plane`;
CREATE TABLE `air_plane`  (
  `air_plane_id` int(11) NOT NULL AUTO_INCREMENT,
  `air_plane_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`air_plane_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of air_plane
-- ----------------------------
INSERT INTO `air_plane` VALUES (1, 'Garuda');
INSERT INTO `air_plane` VALUES (4, 'adasd');

-- ----------------------------
-- Table structure for booking
-- ----------------------------
DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking`  (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_airplane_id` int(11) NOT NULL,
  `id_card` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_card_upload` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`booking_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of booking
-- ----------------------------
INSERT INTO `booking` VALUES (1, 1, '1372016501880063', 'Test', '6567ff9f40819.jpeg', 2);
INSERT INTO `booking` VALUES (2, 2, '13213213', 'Tambujin Rejin', 'zs8gdhxZPJnRHczeai5PmTJvXDEZgvsIaHa1l2iP.jpg', 2);
INSERT INTO `booking` VALUES (3, 3, '1372016501880063', 'gizmo', 'htlJZrz3lUdOfcy3IPdMefch3gnMq9OCf6kovRrH.jpg', 2);
INSERT INTO `booking` VALUES (4, 2, '1372016501880063', 'gizmo', 'z1WLrUFDHVPd20OYO8hb9Kyp2Vcb2a3ybfFogzie.jpg', 4);
INSERT INTO `booking` VALUES (5, 3, '1256110651651', 'Tambujin Rejin', '9MhYrRHOhKtHaTS6fgdQZE21eXLZKpJmp2HvLXhj.png', 4);

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment`  (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `upload_proof` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('Booking','Payment Accepted','Payment Rejected','Cancel') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment
-- ----------------------------
INSERT INTO `payment` VALUES (1, 1, 1, '6567ff9f41146.jpeg', 'Cancel');
INSERT INTO `payment` VALUES (2, 2, 1, 'PuefqDuslcVzgOckcGpeRxDBlnjiIPtAz7FmkJJ9.jpg', 'Cancel');
INSERT INTO `payment` VALUES (3, 3, 1, 'dSfQ6wXhf7k1fJjUgMSAbl8bZJyrTExMFpOxNebk.jpg', 'Payment Rejected');
INSERT INTO `payment` VALUES (4, 4, 4, '2J2Jwx4ev3BE687YqlqXow1dzVq0JTYepMob5Rdb.jpg', 'Cancel');
INSERT INTO `payment` VALUES (5, 5, 4, 'Kr6yGqoK8PdDq5ngjIavTB5XuBpiayXtf58HTk52.jpg', 'Cancel');

-- ----------------------------
-- Table structure for sch_air_plane
-- ----------------------------
DROP TABLE IF EXISTS `sch_air_plane`;
CREATE TABLE `sch_air_plane`  (
  `sch_air_plane_id` int(11) NOT NULL AUTO_INCREMENT,
  `air_plane_id` int(11) NOT NULL,
  `schedule` datetime NOT NULL,
  `sch_price` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`sch_air_plane_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sch_air_plane
-- ----------------------------
INSERT INTO `sch_air_plane` VALUES (1, 1, '2023-12-01 10:14:00', 5000000, NULL);
INSERT INTO `sch_air_plane` VALUES (2, 1, '2024-01-04 10:14:00', 5000000, '2023-12-12 11:28:18');
INSERT INTO `sch_air_plane` VALUES (3, 1, '2024-01-05 10:14:00', 5000000, NULL);
INSERT INTO `sch_air_plane` VALUES (4, 1, '2023-12-09 11:30:01', 2500000, NULL);
INSERT INTO `sch_air_plane` VALUES (5, 1, '2023-12-05 11:30:01', 2500000, NULL);
INSERT INTO `sch_air_plane` VALUES (6, 1, '2023-12-14 11:30:01', 2500000, NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_mobile` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `type` enum('admin','customer') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'customer',
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin@gmail.com', '+625455649685', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'Okri', 'admin', NULL);
INSERT INTO `user` VALUES (2, 'okri@gmail.com', '+6254151515', 'e10adc3949ba59abbe56e057f20f883e', 'okri', 'Okri', 'customer', NULL);
INSERT INTO `user` VALUES (4, 'prihuda24@gmail.com', '082113580198', '6c44e5cd17f0019c64b042e4a745412a', 'alhadi12', 'Tambujin Rejin', 'customer', NULL);
INSERT INTO `user` VALUES (5, 'prihuda24@gmail.com', '082113580198', 'e10adc3949ba59abbe56e057f20f883e', 'alhadi13', 'Tamwbujin Rejin', 'customer', NULL);
INSERT INTO `user` VALUES (6, 'prihuda24@gmail.com', '082113580198', 'e10adc3949ba59abbe56e057f20f883e', 'alhadi14', 'Tawqembujin Rejin', 'customer', NULL);

-- ----------------------------
-- Procedure structure for create_update_sys_filter
-- ----------------------------
DROP PROCEDURE IF EXISTS `create_update_sys_filter`;
delimiter ;;
CREATE PROCEDURE `create_update_sys_filter`(IN p_tablename VARCHAR(50),
    IN p_filtername VARCHAR(50),
    IN p_query VARCHAR(2000),
    IN p_type VARCHAR(5),
    IN p_groupfilterid INT,
    IN p_reftablename VARCHAR(50),
    IN p_reffieldname VARCHAR(50),
    IN p_reftype VARCHAR(5),
    IN p_reffilter VARCHAR(1000),
    IN p_flags VARCHAR(50),
    IN p_rulelabel VARCHAR(50))
BEGIN

    DECLARE l_id INT;

    SELECT filterid INTO l_id
    FROM sys_filter 
    WHERE tablename = p_tablename
    AND filtername = p_filtername
    LIMIT 1;

    IF (l_id IS NULL) THEN
        INSERT INTO sys_filter (
            tablename,
            filtername,
            query,
            type,
            groupfilterid,
            reftablename,
            reffieldname,
            reftype,
            reffilter,
            flags,
            rulelabel,
            createdate,
            createby,
            lastmoddate,
            lastmodby
        ) VALUES (
            p_tablename,
            p_filtername,
            p_query,
            p_type,
            p_groupfilterid,
            p_reftablename,
            p_reffieldname,
            p_reftype,
            p_reffilter,
            p_flags,
            p_rulelabel,
            NOW(),
            0,
            NOW(),
            0
        );
    ELSE
        UPDATE sys_filter SET
            tablename = p_tablename,
            filtername = p_filtername,
            query = p_query,
            type = p_type,
            groupfilterid = p_groupfilterid,
            reftablename = p_reftablename,
            reffieldname = p_reffieldname,
            reftype = p_reftype,
            reffilter = p_reffilter,
            flags = p_flags,
            rulelabel = p_rulelabel,
            lastmoddate = NOW(),
            lastmodby = 0
        WHERE filterid = l_id;
    END IF;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for temp_procedure
-- ----------------------------
DROP PROCEDURE IF EXISTS `temp_procedure`;
delimiter ;;
CREATE PROCEDURE `temp_procedure`()
BEGIN

    # default configuration for all

    CALL create_update_sys_filter('customer', 'createdate_or_lastmoddate_from', 'date(createdate)>=%S% or date(lastmoddate)>=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'createdate_or_lastmoddate_is', 'date(createdate)=%S% or date(lastmoddate)=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'createdate_or_lastmoddate_to', 'date(createdate)<=%S% or date(lastmoddate)<=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'email', 'email like %T%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'firstname', 'firstname=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'lastname', 'lastname=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'mobileno', 'mobileno like %T%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'nationalityid', 'nationalityid=%I%', 'I', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'not_in_use', 'not_in_use', 'I', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'orgcreatedate_or_orglastmoddate_from', 'date(orgcreatedate)>=%S% or date(orglastmoddate)>=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'orgcreatedate_or_orglastmoddate_is', 'date(orgcreatedate)=%S% or date(orglastmoddate)=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'orgcreatedate_or_orglastmoddate_to', 'date(orgcreatedate)<=%S% or date(orglastmoddate)<=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customer', 'createdate_or_lastmoddate_is_with_lucid', '(date(createdate)=%S% or date(lastmoddate)=%S%) AND orgid3 IS NOT NULL', 'C', '0', null, null, null, null, null, null);

    CALL create_update_sys_filter('RESERVED', 'RESERVED', 'RESERVED', 'C', '0', null, null, null, null, null, null);
    
    CALL create_update_sys_filter('transaction', 'amount1_from', 'amount1>=%I%', 'I', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'amount1_to', 'amount1<=%I%', 'I', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'createdate_from', 'date(createdate)>=%S%', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'createdate_is', 'date(createdate)=%S%', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'createdate_to', 'date(createdate)<=%S%', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'custid', 'custid=%I%', 'D', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'date1_from', 'date1>=%D%', 'D', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'date1_from_s', 'date(date1)>=%S%', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'date1_is', 'date(date1)=%S%', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'date1_to', 'date1<=%E%', 'I', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'date1_to_s', 'date(date1)<=%S%', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'orgcreatedate_from', 'date(orgcreatedate)>=%S%', 'C', '6', null, null, null, null, null, 'Purchase Period From');
    CALL create_update_sys_filter('transaction', 'orgcreatedate_is', 'date(orgcreatedate)=%S%', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'orgcreatedate_to', 'date(orgcreatedate)<=%S%', 'C', '6', null, null, null, null, null, 'Purchase Period To');
    CALL create_update_sys_filter('transaction', 'statusid_is', 'statusid=%I%', 'I', '6', 'transaction', 'statusid', 'E', null, null, null);
    CALL create_update_sys_filter('transaction', 'statusid_is_not', 'statusid!=%I%', 'I', '6', 'transaction', 'statusid', 'E', null, null, null);
    CALL create_update_sys_filter('transaction', 'text1', 'text1=%S%', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'text1_like', 'text1 LIKE %S%', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'text1_with_transitem', 'text1 LIKE %S% AND (transid IN (SELECT t2.transid FROM transactionitem t2))', 'C', '6', null, null, null, null, null, null);

    CALL create_update_sys_filter('transaction', 'date1_from_d', 'datediff(date1,now())>=%I%', 'I', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'date1_to_d', 'datediff(date1,now())<=%I%', 'I', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'typeid', 'typeid in (%S%)', 'C', '6', 'transaction', 'typeid', 'E', null, null, null);
    CALL create_update_sys_filter('transaction', 'propertyid', 'propertyid in (%S%)', 'C', '6', 'property', 'id', 'T', null, null, null);
    CALL create_update_sys_filter('transaction', 'outletid', 'outletid in (%S%)', 'C', '6', 'outlet', 'id', 'T', null, null, 'Bought in specific outlet');
    CALL create_update_sys_filter('transaction', 'propertyids', 'propertyid in (select propertyid from property where code in (%S%))', 'C', '6', 'property', 'id', 'T', null, null, null);
    CALL create_update_sys_filter('transaction', 'outletids', 'outletid in (select outletid from outlet where code in (%S%))', 'C', '6', 'outlet', 'id', 'T', null, null, null);

    CALL create_update_sys_filter('transaction', 'orgid1', 'orgid1=%S%', 'C', '6', null, null, null, null, null, 'Bought specific product');
    CALL create_update_sys_filter('transaction', 'orgid2', 'orgid2=%S%', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'orgid3', 'orgid3=%S%', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'avgamount1_is', 'avg(amount1)=%F%', 'F', '6', null, null, null, null, null, 'Average Transaction Value');
    CALL create_update_sys_filter('transaction', 'counttrans_is', 'count(1)=%I%', 'I', '6', null, null, null, null, null, 'Transaction Count');
    CALL create_update_sys_filter('transaction', 'createdate_fromday', 'createdate >= (CURDATE() - INTERVAL %I% DAY)', 'I', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'customer_gender', 'custid in (select custid from customer where gender=%S%)', 'C', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'customer_memberlevel', 'custid in (select custid from member where mbrlevelid=%I%)', 'I', '6', null, null, null, null, null, 'Membership Tier');
    CALL create_update_sys_filter('transaction', 'qty1_is', 'qty1=%I%', 'I', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'qty2_is', 'qty2=%I%', 'I', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'qty3_is', 'qty3=%I%', 'I', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'amount1_is', 'amount1=%F%', 'F', '6', null, null, null, null, null, 'Transaction Value');
    CALL create_update_sys_filter('transaction', 'amount2_is', 'amount2=%F%', 'F', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'amount3_is', 'amount3=%F%', 'F', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'amount4_is', 'amount4=%F%', 'F', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'amount5_is', 'amount5=%F%', 'F', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'point1_is', 'point1=%F%', 'F', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'point2_is', 'point2=%F%', 'F', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'point3_is', 'point3=%F%', 'F', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('transaction', 'createdate_is_with_lucid', 'date(createdate)=%S% AND custid IN (SELECT custid FROM customer c WHERE c.orgid3 IS NOT NULL)', 'C', '6', null, null, null, null, null, null);

    CALL create_update_sys_filter('customeraward', 'createdate_from', 'createdate>=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customeraward', 'createdate_to', 'createdate<=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customeraward', 'lastmoddate_from', 'lastmoddate>=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customeraward', 'lastmoddate_to', 'lastmoddate<=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customeraward', 'statusid_is', 'statusid=%I%', 'I', '0', 'customeraward', 'statusid', 'E', null, null, null);
    CALL create_update_sys_filter('customeraward', 'typeid_is', 'typeid=%I%', 'I', '0', 'null', null, null, null, null, null);
    CALL create_update_sys_filter('customeraward', 'point_fixed', 'point=%F%', 'F', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('customeraward', 'point_multiplied', 'point=%F%*%F%', 'F', '6', null, null, null, null, null, null);

    CALL create_update_sys_filter('transaction', 'trans_with_transitem', 'transid IN (SELECT t2.transid FROM transactionitem t2 where 1=%I%)', 'I', '6', null, null, null, null, null, null);
    CALL create_update_sys_filter('member', 'activatedate_from', 'activatedate>=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('member', 'activatedate_to', 'activatedate<=%S%', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customeraward', 'rewardid_is', 'rewardid IN (SELECT mr.rewardid FROM memberreward mr WHERE category=%S%)', 'C', '0', null, null, null, null, null, null);
    CALL create_update_sys_filter('customeraward', 'issuedate_month', 'month(issuedate)=%S%', 'C', '0', null, null, null, null, null, null);

END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
