USE [MINIAPPS]
GO
/****** Object:  Table [dbo].[InternetProducts]    Script Date: 11/01/2020 19:10:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[InternetProducts](
	[ProductID] [int] IDENTITY(100000,1) NOT NULL,
	[ProductUID] [varchar](36) NULL,
	[GID] [int] NULL,
	[ProductName] [varchar](50) NULL,
	[Price] [float] NULL,
	[UploadSpeed] [int] NULL,
	[DownloadSpeed] [int] NULL,
	[Technology] [varchar](50) NULL,
	[StaticIP] [int] NULL,
	[Status] [int] NULL,
	[CreatedBy] [int] NULL,
	[CreatedDate] [smalldatetime] NULL,
 CONSTRAINT [PK_InternetProducts] PRIMARY KEY CLUSTERED 
(
	[ProductID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[InternetProducts] ON
INSERT [dbo].[InternetProducts] ([ProductID], [ProductUID], [GID], [ProductName], [Price], [UploadSpeed], [DownloadSpeed], [Technology], [StaticIP], [Status], [CreatedBy], [CreatedDate]) VALUES (100000, N'02867CEF-6D1A-4285-8C5B-2D41F01EC9E5', 1000000000, N'FUP30M50MB1000G', 500, 50, 40, N'Fiber', 0, 1, 10000110, CAST(0xAC660000 AS SmallDateTime))
INSERT [dbo].[InternetProducts] ([ProductID], [ProductUID], [GID], [ProductName], [Price], [UploadSpeed], [DownloadSpeed], [Technology], [StaticIP], [Status], [CreatedBy], [CreatedDate]) VALUES (100001, N'22867CEF-2D1A-4285-8C5B-2D41F01EGGE5', 1000000000, N'FUP30M50MB100G', 500, 50, 40, N'DialUp', 0, 1, 10000110, CAST(0xAC660000 AS SmallDateTime))
INSERT [dbo].[InternetProducts] ([ProductID], [ProductUID], [GID], [ProductName], [Price], [UploadSpeed], [DownloadSpeed], [Technology], [StaticIP], [Status], [CreatedBy], [CreatedDate]) VALUES (100002, N'78867CEF-2D9A-4285-8B5B-2D41F01FG6E5', 1000000000, N'FUP30M150MB1000G', 500, 150, 200, N'Fiber', 1, 1, 10000110, CAST(0xAC660000 AS SmallDateTime))
SET IDENTITY_INSERT [dbo].[InternetProducts] OFF
