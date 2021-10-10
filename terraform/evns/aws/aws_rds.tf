## サブネットグループ
resource "aws_db_subnet_group" "naoki-dbtf-sg" {
    name = "naoki-dbtf-sg"
    description = "naoki-dbtf-sg"
    subnet_ids = [aws_subnet.public-a.id, aws_subnet.public-c.id]
}

## パラメーターグループ
resource "aws_db_parameter_group" "naoki-dbtf-pg57" {
    family = "mysql5.7"
    name = "naoki-dbtf-pg57"
    description = "naoki-dbtf-pg57"

    parameter {
        name  = "character_set_client"
        value = "utf8"
    }
    parameter {
        name  = "character_set_connection"
        value = "utf8"
    }
    parameter {
        name  = "character_set_database"
        value = "utf8"
    }
    parameter {
        name  = "character_set_server"
        value = "utf8"
    }
    parameter {
        name  = "character_set_results"
        value = "utf8"
    }
}

## RDSの作成
resource "aws_db_instance" "naoki-dbtf-instance" {
    engine = "mysql"
    engine_version = "5.7.33"
    identifier = "naoki-dbtf-instance"
    username = "root"
    password = "11922960kim"//構築後に変更
    skip_final_snapshot = true

    instance_class = "db.t3.micro"
    storage_type = "gp2"
    allocated_storage = "20"
    publicly_accessible  = true

    vpc_security_group_ids = [ aws_security_group.naoki-dbtf-sec.id ]
    db_subnet_group_name = aws_db_subnet_group.naoki-dbtf-sg.name

    port = "3306"
}
