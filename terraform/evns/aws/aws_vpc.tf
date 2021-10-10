## VPCの設定
resource "aws_vpc" "naoki-wptf-vpc" {
    cidr_block = "10.0.0.0/16"
    instance_tenancy = "default"
    enable_dns_support = true
    enable_dns_hostnames = true

    tags = {
        Name = "naoki-wptf-vpc"
    }   
}

## サブネットの作成(1a)
resource "aws_subnet" "public-a" {
    vpc_id = aws_vpc.naoki-wptf-vpc.id
    cidr_block = "10.0.0.0/24"
    availability_zone = "ap-northeast-1a"
    tags = {
        Name = "public-wptf-a"
    }
}

## サブネットの作成(1c)
resource "aws_subnet" "public-c" {
    vpc_id = aws_vpc.naoki-wptf-vpc.id
    cidr_block = "10.0.1.0/24"
    availability_zone = "ap-northeast-1c"
    tags = {
        Name = "public-wptf-c"
    }
}

## ゲートウェイの追加
resource "aws_internet_gateway" "naoki-wptf-GW" {
    vpc_id = aws_vpc.naoki-wptf-vpc.id
}

## ルートテーブルの追加(0.0.0.0/0)
resource "aws_route_table" "public-wptf-route" {
    vpc_id = aws_vpc.naoki-wptf-vpc.id

    route {
        cidr_block = "0.0.0.0/0"
        gateway_id = aws_internet_gateway.naoki-wptf-GW.id
    }
}

## ルートテーブルの追加(1a)
resource "aws_route_table_association" "public-a" {
    subnet_id = aws_subnet.public-a.id
    route_table_id = aws_route_table.public-wptf-route.id
}

## ルートテーブルの追加(1c)
resource "aws_route_table_association" "public-c" {
    subnet_id = aws_subnet.public-c.id
    route_table_id = aws_route_table.public-wptf-route.id
}