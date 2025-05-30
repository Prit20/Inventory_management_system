USE [master]
GO
/****** Object:  Database [Inventory_System]    Script Date: 14-May-25 8:15:53 AM ******/
CREATE DATABASE [Inventory_System]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'Inventory_System', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\Inventory_System.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'Inventory_System_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\Inventory_System_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [Inventory_System] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [Inventory_System].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [Inventory_System] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [Inventory_System] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [Inventory_System] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [Inventory_System] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [Inventory_System] SET ARITHABORT OFF 
GO
ALTER DATABASE [Inventory_System] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [Inventory_System] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [Inventory_System] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [Inventory_System] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [Inventory_System] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [Inventory_System] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [Inventory_System] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [Inventory_System] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [Inventory_System] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [Inventory_System] SET  DISABLE_BROKER 
GO
ALTER DATABASE [Inventory_System] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [Inventory_System] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [Inventory_System] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [Inventory_System] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [Inventory_System] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [Inventory_System] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [Inventory_System] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [Inventory_System] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [Inventory_System] SET  MULTI_USER 
GO
ALTER DATABASE [Inventory_System] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [Inventory_System] SET DB_CHAINING OFF 
GO
ALTER DATABASE [Inventory_System] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [Inventory_System] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [Inventory_System] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [Inventory_System] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [Inventory_System] SET QUERY_STORE = ON
GO
ALTER DATABASE [Inventory_System] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [Inventory_System]
GO
/****** Object:  Table [dbo].[AssignedAssets]    Script Date: 14-May-25 8:15:53 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[AssignedAssets](
	[Sr.No] [int] IDENTITY(1,1) NOT NULL,
	[Assignment_Id] [int] NOT NULL,
	[Employee_Id] [nvarchar](50) NULL,
	[Description] [nvarchar](50) NULL,
	[Plant_Name] [nvarchar](50) NULL,
	[Assignment_Date] [datetime] NULL,
	[Device_Category] [nvarchar](50) NULL,
	[Company_Name] [nvarchar](50) NULL,
	[Serial_Number] [nvarchar](50) NULL,
	[Remark] [nvarchar](150) NULL,
	[CreatedBy] [nvarchar](50) NULL,
	[CreatedAt] [datetime] NULL,
	[UpdatedBy] [nvarchar](50) NULL,
	[UpdatedAt] [datetime] NULL,
 CONSTRAINT [PK_AssignedAssets_1] PRIMARY KEY CLUSTERED 
(
	[Sr.No] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CategoryAssign]    Script Date: 14-May-25 8:15:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CategoryAssign](
	[Id] [int] NOT NULL,
	[Sr_No] [int] NULL,
	[Location] [nvarchar](255) NULL,
	[PO_No] [nvarchar](255) NULL,
	[Invoice_No] [nvarchar](255) NULL,
	[Party_Name] [nvarchar](255) NULL,
	[Item] [nvarchar](max) NULL,
	[Qty] [int] NULL,
	[Basic_Rate] [decimal](18, 2) NULL,
	[Remarks] [nvarchar](max) NULL,
	[Category_Id] [int] NULL,
	[Category_Name] [nvarchar](255) NULL,
	[CreatedAt] [datetime] NULL,
	[CreatedBy] [nvarchar](100) NULL,
	[UpdatedAt] [datetime] NULL,
	[UpdatedBy] [nvarchar](100) NULL,
	[Is_Deleted] [bit] NULL,
	[Warranty_Type] [varchar](50) NULL,
	[Warranty_Start] [date] NULL,
	[Warranty_End] [date] NULL,
	[Guarantee_Type] [varchar](50) NULL,
	[Guarantee_Start] [date] NULL,
	[Guarantee_End] [date] NULL,
	[Is_Assigned] [int] NULL,
 CONSTRAINT [PK__Category__3214EC07C0D8C553] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CompanyName]    Script Date: 14-May-25 8:15:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CompanyName](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[Company_Name] [nvarchar](50) NULL,
	[CreatedAt] [datetime] NULL,
	[CreatedBy] [nvarchar](50) NULL,
	[UpdatedAt] [datetime] NULL,
	[UpdatedBy] [nvarchar](50) NULL,
	[Is_Deleted] [bit] NULL,
 CONSTRAINT [PK_CompanyName] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DeviceCategory]    Script Date: 14-May-25 8:15:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DeviceCategory](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[Device_Category] [nvarchar](50) NULL,
	[Type] [nvarchar](50) NULL,
	[SrNo_Required] [int] NULL,
	[Detail_Required] [int] NULL,
	[CreatedAt] [datetime] NULL,
	[CreatedBy] [nvarchar](50) NULL,
	[UpdatedAt] [datetime] NULL,
	[UpdatedBy] [nvarchar](50) NULL,
	[Is_Deleted] [bit] NULL,
 CONSTRAINT [PK_DeviceCategory] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SerialNumberAssignment]    Script Date: 14-May-25 8:15:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SerialNumberAssignment](
	[Id] [int] NOT NULL,
	[Assign_Id] [int] NULL,
	[Sr_No] [varchar](50) NULL,
	[Location] [nvarchar](255) NULL,
	[PO_No] [nvarchar](255) NULL,
	[Invoice_No] [nvarchar](255) NULL,
	[Party_Name] [nvarchar](255) NULL,
	[Item] [nvarchar](255) NULL,
	[Qty] [int] NULL,
	[Basic_Rate] [nvarchar](255) NULL,
	[Remarks] [nvarchar](255) NULL,
	[Category_Name] [nvarchar](50) NULL,
	[Serial_Number] [nvarchar](255) NULL,
	[Model_Number] [nvarchar](255) NULL,
	[Company_Name] [nvarchar](255) NULL,
	[Manufacture_Date] [date] NULL,
	[Sr_Remark] [nvarchar](255) NULL,
	[MAC_Address] [nvarchar](255) NULL,
	[IP_Address] [nvarchar](255) NULL,
	[RAM] [nvarchar](255) NULL,
	[Hard_Disk] [nvarchar](255) NULL,
	[Graphics] [nvarchar](255) NULL,
	[Created_At] [datetime] NULL,
	[Created_By] [nvarchar](50) NULL,
 CONSTRAINT [PK__SerialNu__3214EC07AC71F282] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[CategoryAssign] ADD  CONSTRAINT [DF__CategoryA__Creat__3E52440B]  DEFAULT (getdate()) FOR [CreatedAt]
GO
ALTER TABLE [dbo].[CategoryAssign] ADD  CONSTRAINT [DF__CategoryA__Is_De__3F466844]  DEFAULT ((0)) FOR [Is_Deleted]
GO
ALTER TABLE [dbo].[CategoryAssign] ADD  DEFAULT ((0)) FOR [Is_Assigned]
GO
ALTER TABLE [dbo].[SerialNumberAssignment] ADD  CONSTRAINT [DF__SerialNum__Creat__4222D4EF]  DEFAULT (getdate()) FOR [Created_At]
GO
USE [master]
GO
ALTER DATABASE [Inventory_System] SET  READ_WRITE 
GO
