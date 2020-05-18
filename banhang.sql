create database BanHang;
use BanHang;
CREATE TABLE `Bình Luận` (
  `MaSP` int(10) NOT NULL,
  `Content` varchar(256) NOT NULL,
  `MaKH` int(10) NOT NULL,
  `MaBL` int(10) NOT NULL,
  `MaBLGoc` int(10) NOT NULL,
  `commentDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Sản Phẩm`
--

CREATE TABLE `Sản Phẩm` (
  `MaSP` int(10) NOT NULL,
  `TenSP` varchar(256) NOT NULL,
  `LoaiSP` varchar(100) NOT NULL,
  `createdDate` datetime NOT NULL,
  `GiaGoc` int(12) DEFAULT NULL,
  `GiaGiam` int(12) DEFAULT NULL,
  `MaCH` int(10) DEFAULT NULL,
  `Description` varchar(256) DEFAULT NULL,
  `DanhGiaTB` float DEFAULT NULL,
  `SoLuongDanhGia` int(10) DEFAULT NULL,
  `SoLuongDaBan` int(10) DEFAULT NULL,
  `SoLuongTonKho` int(10) DEFAULT NULL,
  `laSPDauGia` tinyint(1) DEFAULT NULL,
  `Image1` varchar(256) DEFAULT NULL,
  `Image2` varchar(256) DEFAULT NULL,
  `Image3` varchar(256) DEFAULT NULL,
  `Deleted` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Sản Phẩm Đơn Hàng`
--

CREATE TABLE `Sản Phẩm Đơn Hàng` (
  `MaDon` int(10) NOT NULL,
  `MaSP` int(10) NOT NULL,
  `SoLuong` int(10) NOT NULL,
  `ThanhTien` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Tài Khoản`
--

CREATE TABLE `Tài Khoản` (
  `MaKH` int(10) NOT NULL,
  `Ten` varchar(100) NOT NULL,
  `DiaChi` varchar(256) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `SDT` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Đơn Hàng`
--

CREATE TABLE `Đơn Hàng` (
  `MaDon` int(10) NOT NULL,
  `TongTien` int(12) NOT NULL,
  `MaKH` int(10) NOT NULL,
  `TenNguoiNhan` varchar(256) NOT NULL,
  `SDT` int(15) NOT NULL,
  `DiaChi` varchar(256) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `MaCH` int(10) NOT NULL,
  `NgayThang` datetime NOT NULL,
  `Deleted` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Đấu Giá`
--

CREATE TABLE `Đấu Giá` (
  `MaKH` int(10) NOT NULL,
  `MaSP` int(10) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `Bình Luận`
--
ALTER TABLE `Bình Luận`
  ADD PRIMARY KEY (`MaBL`),
  ADD KEY `FK2_table6` (`MaKH`);

--
-- Chỉ mục cho bảng `Sản Phẩm`
--
ALTER TABLE `Sản Phẩm`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `FK_table1` (`MaCH`);

--
-- Chỉ mục cho bảng `Sản Phẩm Đơn Hàng`
--
ALTER TABLE `Sản Phẩm Đơn Hàng`
  ADD PRIMARY KEY (`MaDon`,`MaSP`),
  ADD KEY `FK2_table5` (`MaSP`);

--
-- Chỉ mục cho bảng `Tài Khoản`
--
ALTER TABLE `Tài Khoản`
  ADD PRIMARY KEY (`MaKH`);

--
-- Chỉ mục cho bảng `Đơn Hàng`
--
ALTER TABLE `Đơn Hàng`
  ADD PRIMARY KEY (`MaDon`),
  ADD KEY `FK_table4` (`MaKH`),
  ADD KEY `FK2_table4` (`MaCH`);

--
-- Chỉ mục cho bảng `Đấu Giá`
--
ALTER TABLE `Đấu Giá`
  ADD PRIMARY KEY (`MaKH`,`MaSP`),
  ADD KEY `FK2_table3` (`MaSP`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `Sản Phẩm`
--
ALTER TABLE `Sản Phẩm`
  MODIFY `MaSP` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `Tài Khoản`
--
ALTER TABLE `Tài Khoản`
  MODIFY `MaKH` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `Đơn Hàng`
--
ALTER TABLE `Đơn Hàng`
  MODIFY `MaDon` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Bình Luận`
  MODIFY `MaBL` int(10) NOT NULL AUTO_INCREMENT;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `Bình Luận`
--
ALTER TABLE `Bình Luận`
  ADD CONSTRAINT `FK2_table6` FOREIGN KEY (`MaKH`) REFERENCES `Tài Khoản` (`MaKH`),
  ADD CONSTRAINT `FK_table6` FOREIGN KEY (`MaSP`) REFERENCES `Sản Phẩm` (`MaSP`);

--
-- Các ràng buộc cho bảng `Sản Phẩm`
--
ALTER TABLE `Sản Phẩm`
  ADD CONSTRAINT `FK_table1` FOREIGN KEY (`MaCH`) REFERENCES `Tài Khoản` (`MaKH`);
alter table `Đơn Hàng`
modify SDT varchar(20) not null;
--
-- Các ràng buộc cho bảng `Sản Phẩm Đơn Hàng`
--
ALTER TABLE `Sản Phẩm Đơn Hàng`
  ADD CONSTRAINT `FK2_table5` FOREIGN KEY (`MaSP`) REFERENCES `Sản Phẩm` (`MaSP`),
  ADD CONSTRAINT `FK_table5` FOREIGN KEY (`MaDon`) REFERENCES `Đơn Hàng` (`MaDon`);

--
-- Các ràng buộc cho bảng `Đơn Hàng`
--
ALTER TABLE `Đơn Hàng`
  ADD CONSTRAINT `FK2_table4` FOREIGN KEY (`MaCH`) REFERENCES `Tài Khoản` (`MaKH`),
  ADD CONSTRAINT `FK_table4` FOREIGN KEY (`MaKH`) REFERENCES `Tài Khoản` (`MaKH`);

--
-- Các ràng buộc cho bảng `Đấu Giá`
--
ALTER TABLE `Đấu Giá`
  ADD CONSTRAINT `FK2_table3` FOREIGN KEY (`MaSP`) REFERENCES `Sản Phẩm` (`MaSP`),
  ADD CONSTRAINT `FK_table3` FOREIGN KEY (`MaKH`) REFERENCES `Tài Khoản` (`MaKH`);
COMMIT;
select * from `Bình Luận`,`Tài Khoản` where MaSP = 1 and MaBLGoc=-1 and `Tài Khoản`.MaKH = `Bình Luận`.MaKH order by MaBL desc;
update `Sản Phẩm` set Deleted = NULL;
SET SQL_SAFE_UPDATES = 0;