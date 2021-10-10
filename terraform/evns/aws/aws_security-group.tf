## security group (ALB)
resource "aws_security_group" "naoki-albtf-sec" {
    name = "naoki-albtf-sec"
    description = "naoki-albtf-sec"
    vpc_id = aws_vpc.naoki-wptf-vpc.id

    ingress {
        to_port = 80
        from_port = 80
        protocol = "tcp"
        cidr_blocks = [ "0.0.0.0/0" ]
    }

    ingress {
        to_port = 80
        from_port = 80
        protocol = "tcp"
        ipv6_cidr_blocks = [ "::/0" ]    
    }

    ingress {
        to_port = 443
        from_port = 443
        protocol = "tcp"
        cidr_blocks = [ "0.0.0.0/0" ]
    }

    ingress {
        to_port = 443
        from_port = 443
        protocol = "tcp"
        ipv6_cidr_blocks = [ "::/0" ]    
    }

    egress {
        to_port = 0
        from_port = 0
        protocol = "-1"
        cidr_blocks = [ "0.0.0.0/0" ]
    } 

    egress {
        to_port = 0
        from_port = 0
        protocol = "-1"
        ipv6_cidr_blocks = [ "::/0" ]
    } 

    tags = {
        Name = "naoki-albtf-sec"
    }
}

## security group (EC2)
resource "aws_security_group" "naoki-ec2tf-sec" {
    name = "naoki-ec2tf-sec"
    description = "naoki-ec2tf-sec"
    vpc_id = aws_vpc.naoki-wptf-vpc.id

    ingress {
        to_port = 80
        from_port = 80
        protocol = "tcp"
        security_groups = [ aws_security_group.naoki-albtf-sec.id ]
    }

    ingress {
        to_port = 22
        from_port = 22
        protocol = "tcp"
        cidr_blocks = [ "0.0.0.0/0" ]
    }

    ingress {
        to_port = 22
        from_port = 22
        protocol = "tcp"
        ipv6_cidr_blocks = [ "::/0" ]    
    }

    egress {
        to_port = 0
        from_port = 0
        protocol = "-1"
        cidr_blocks = [ "0.0.0.0/0" ]
    } 

    egress {
        to_port = 0
        from_port = 0
        protocol = "-1"
        ipv6_cidr_blocks = [ "::/0" ]
    } 

    tags = {
        Name = "naoki-ec2tf-sec"
    }
}

## security group (RDS)
resource "aws_security_group" "naoki-dbtf-sec" {
    name = "naoki-dbtf-sec"
    description = "naoki-dbtf-sec"
    vpc_id = aws_vpc.naoki-wptf-vpc.id

    ingress {
        to_port = 3306
        from_port = 3306
        protocol = "tcp"
        security_groups = [ aws_security_group.naoki-ec2tf-sec.id ]
    }

    egress {
        to_port = 0
        from_port = 0
        protocol = "-1"
        cidr_blocks = [ "0.0.0.0/0" ]
    } 

    egress {
        to_port = 0
        from_port = 0
        protocol = "-1"
        ipv6_cidr_blocks = [ "::/0" ]
    } 

    tags = {
        Name = "naoki-dbtf-sec"
    }
}