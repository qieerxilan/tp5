-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-12-11 14:27:05
-- 服务器版本： 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tang`
--

-- --------------------------------------------------------

--
-- 表的结构 `tang_category`
--

CREATE TABLE `tang_category` (
  `cid` int(11) NOT NULL,
  `category_title` varchar(30) DEFAULT NULL,
  `category_pid` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `user_uid` int(11) DEFAULT NULL,
  `category_volume` varchar(200) DEFAULT NULL COMMENT '浏览量',
  `category_delete` int(3) DEFAULT NULL COMMENT '软删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tang_category`
--

INSERT INTO `tang_category` (`cid`, `category_title`, `category_pid`, `description`, `user_uid`, `category_volume`, `category_delete`) VALUES
(1, '社区', 0, NULL, NULL, NULL, NULL),
(2, '生活馆', 0, NULL, NULL, NULL, NULL),
(4, '晚间故事', 1, NULL, NULL, NULL, NULL),
(5, '关注热点', 1, NULL, NULL, NULL, NULL),
(6, '文章精选', 1, 'asdasdas', 0, NULL, NULL),
(7, '达人精选', 1, NULL, NULL, NULL, NULL),
(8, '音乐', 2, NULL, NULL, NULL, NULL),
(9, '视频', 2, NULL, NULL, NULL, NULL),
(10, '生活问答', 2, NULL, NULL, NULL, NULL),
(11, '文章', 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tang_enjoy`
--

CREATE TABLE `tang_enjoy` (
  `eid` int(11) NOT NULL,
  `enjoy_uid` int(11) DEFAULT NULL,
  `enjoy_tid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tang_enjoy`
--

INSERT INTO `tang_enjoy` (`eid`, `enjoy_uid`, `enjoy_tid`) VALUES
(28, 91, 36),
(29, 91, 34),
(30, 91, 34),
(31, 91, 34),
(32, 91, 34),
(33, 91, 34),
(34, 91, 39),
(35, 91, 34),
(36, 91, 34),
(37, 91, 34),
(38, 91, 34),
(39, 91, 36),
(40, 91, 34),
(41, 91, 36);

-- --------------------------------------------------------

--
-- 表的结构 `tang_house`
--

CREATE TABLE `tang_house` (
  `hid` int(11) NOT NULL,
  `user_uid` int(11) DEFAULT NULL,
  `replay_rid` int(11) DEFAULT NULL,
  `house_content` varchar(200) DEFAULT NULL,
  `house_createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='盖楼回复表';

-- --------------------------------------------------------

--
-- 表的结构 `tang_levy`
--

CREATE TABLE `tang_levy` (
  `lid` int(11) NOT NULL,
  `levy_uid` int(11) NOT NULL,
  `levy_rid` int(11) NOT NULL COMMENT 'replay 主键',
  `levy_content` varchar(200) NOT NULL COMMENT '楼层内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tang_quest`
--

CREATE TABLE `tang_quest` (
  `qid` int(11) NOT NULL,
  `quest_ask` varchar(50) DEFAULT NULL COMMENT '提问',
  `category_cid` int(11) DEFAULT NULL,
  `quest_answer` varchar(200) DEFAULT NULL COMMENT '回答',
  `quest_aid` int(2) DEFAULT NULL COMMENT '用来分类是问题还是答案'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tang_replay`
--

CREATE TABLE `tang_replay` (
  `rid` int(11) NOT NULL,
  `text_tid` int(11) DEFAULT NULL,
  `replay_createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_uid` int(11) DEFAULT NULL,
  `replay_content` varchar(300) DEFAULT NULL COMMENT '回复内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tang_replay`
--

INSERT INTO `tang_replay` (`rid`, `text_tid`, `replay_createtime`, `user_uid`, `replay_content`) VALUES
(2, 34, '2016-12-11 11:55:52', 91, 'asdasdas'),
(3, 34, '2016-12-11 13:42:53', 91, '爱我的无群多'),
(4, 34, '2016-12-11 14:34:42', 91, '爱我的无群多'),
(5, 36, '2016-12-11 15:02:21', 91, 'weafeaf');

-- --------------------------------------------------------

--
-- 表的结构 `tang_smallsection`
--

CREATE TABLE `tang_smallsection` (
  `sid` int(11) NOT NULL,
  `label` varchar(30) DEFAULT NULL COMMENT '标签',
  `category_cid` int(11) DEFAULT NULL,
  `test_tid` int(11) DEFAULT NULL COMMENT 'test表主键',
  `small_pid` int(11) DEFAULT NULL COMMENT '与自身主键相关联',
  `small_delete` int(11) DEFAULT NULL COMMENT '软删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='最小板块表';

--
-- 转存表中的数据 `tang_smallsection`
--

INSERT INTO `tang_smallsection` (`sid`, `label`, `category_cid`, `test_tid`, `small_pid`, `small_delete`) VALUES
(3, 'www', NULL, 33, NULL, NULL),
(4, '呃呃呃', NULL, 33, NULL, NULL),
(5, '我我我', NULL, 34, NULL, NULL),
(6, '1111', NULL, 34, NULL, NULL),
(7, '777', NULL, 34, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tang_test`
--

CREATE TABLE `tang_test` (
  `tid` int(11) NOT NULL,
  `user_uid` int(11) DEFAULT NULL,
  `small_sid` int(11) DEFAULT NULL,
  `textcreate_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `test_original` int(2) DEFAULT NULL COMMENT '0,1判断转发不转发',
  `test_video` varchar(50) DEFAULT NULL,
  `test_picture` varchar(50) DEFAULT NULL COMMENT '图片',
  `test_article` varchar(200) DEFAULT NULL COMMENT '文章',
  `test_title` text,
  `test_label` varchar(50) DEFAULT NULL,
  `collectionnum` int(200) DEFAULT NULL COMMENT '收藏',
  `test_rep` tinyint(4) DEFAULT '0' COMMENT '举报'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='发表文章表';

--
-- 转存表中的数据 `tang_test`
--

INSERT INTO `tang_test` (`tid`, `user_uid`, `small_sid`, `textcreate_time`, `test_original`, `test_video`, `test_picture`, `test_article`, `test_title`, `test_label`, `collectionnum`, `test_rep`) VALUES
(34, 91, NULL, '2016-12-10 15:35:06', NULL, NULL, '20161210/0bba963957570e51787224b88e90c640.jpg', '其味无穷', NULL, NULL, NULL, NULL),
(36, 91, NULL, '2016-12-10 15:49:06', NULL, NULL, '20161210/959e10db15ed013104a7575270adab2e.jpg', 'rrrrrrr', NULL, 'wew', NULL, NULL),
(39, 91, NULL, '2016-12-10 18:52:26', NULL, NULL, '20161210/c2fb272e6061228fd1fd5613a4e51b71.jpg', '阿斯顿发斯蒂芬', NULL, '发发发', NULL, NULL),
(40, 91, NULL, '2016-12-11 16:08:46', NULL, NULL, '20161211/8177f239d5201becef6a0628840f0f7f.jpg', '的撒大所大所', NULL, '哈哈', NULL, 1),
(41, 92, NULL, '2016-12-11 16:23:57', NULL, NULL, '20161211/2ce5ce8e5382f0b6a892dca61389d07d.jpg', 'werfwerqwer', NULL, '阿扎尔', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tang_user`
--

CREATE TABLE `tang_user` (
  `uid` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` char(32) NOT NULL,
  `qqemail` varchar(50) DEFAULT NULL COMMENT 'qq邮箱',
  `avatar` varchar(60) DEFAULT NULL,
  `sex` int(2) DEFAULT NULL,
  `hobby` varchar(32) DEFAULT NULL,
  `perlabel` varchar(32) DEFAULT NULL COMMENT '个性签名',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address` varchar(50) DEFAULT NULL COMMENT '籍贯',
  `tel` int(15) DEFAULT NULL,
  `birth` varchar(10) DEFAULT NULL COMMENT '出生日期',
  `nickname` varchar(10) DEFAULT NULL COMMENT '昵称',
  `user_type` varchar(5) DEFAULT NULL COMMENT '权限',
  `uer_follow` varchar(20) DEFAULT NULL COMMENT '关注',
  `user_fans` varchar(20) DEFAULT NULL COMMENT '粉丝',
  `last_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(30) DEFAULT NULL COMMENT '登录ip',
  `integration` int(100) DEFAULT NULL,
  `works` varchar(30) DEFAULT NULL,
  `login_num` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `tang_user`
--

INSERT INTO `tang_user` (`uid`, `username`, `password`, `qqemail`, `avatar`, `sex`, `hobby`, `perlabel`, `create_time`, `address`, `tel`, `birth`, `nickname`, `user_type`, `uer_follow`, `user_fans`, `last_time`, `login_ip`, `integration`, `works`, `login_num`) VALUES
(91, 'wwwwww', 'd785c99d298a4e9e6e13fe99e602ef42', NULL, '20161209/bf03e2260a76f3e05548ad07524bce87.jpg', 0, NULL, '而我却二无群二', '2016-12-09 16:43:10', NULL, 2147483647, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '王企鹅热无群', 0),
(92, 'rrrrrr', 'ff2f24f8b6d253bb5a8bc55728ca7372', NULL, '20161211/e2d72cc2b20fa7ba82e81eaba31690b7.jpg', 0, NULL, '', '2016-12-11 16:21:30', NULL, 2147483647, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1),
(94, '科斯塔', '96e79218965eb72c92a549dd5a330112', NULL, NULL, NULL, NULL, NULL, '2016-12-11 16:56:11', NULL, 2147483647, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(95, 'uuuuuu', '8de1ebe5220196d6acdb486f346fe162', NULL, '20161211/dcb338cdb78456c8b47d9cfd085d67a7.jpg', 0, NULL, '', '2016-12-11 16:57:57', NULL, 2147483647, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '超级巨星', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tang_category`
--
ALTER TABLE `tang_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tang_enjoy`
--
ALTER TABLE `tang_enjoy`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `tang_house`
--
ALTER TABLE `tang_house`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `tang_levy`
--
ALTER TABLE `tang_levy`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `tang_quest`
--
ALTER TABLE `tang_quest`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `tang_replay`
--
ALTER TABLE `tang_replay`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `tang_smallsection`
--
ALTER TABLE `tang_smallsection`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `tang_test`
--
ALTER TABLE `tang_test`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `tang_user`
--
ALTER TABLE `tang_user`
  ADD PRIMARY KEY (`uid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tang_category`
--
ALTER TABLE `tang_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `tang_enjoy`
--
ALTER TABLE `tang_enjoy`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- 使用表AUTO_INCREMENT `tang_house`
--
ALTER TABLE `tang_house`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `tang_levy`
--
ALTER TABLE `tang_levy`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `tang_quest`
--
ALTER TABLE `tang_quest`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `tang_replay`
--
ALTER TABLE `tang_replay`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `tang_smallsection`
--
ALTER TABLE `tang_smallsection`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `tang_test`
--
ALTER TABLE `tang_test`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- 使用表AUTO_INCREMENT `tang_user`
--
ALTER TABLE `tang_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
