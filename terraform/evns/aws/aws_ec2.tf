# ## 鍵の設定（ここは手動で作成）
# resource "aws_key_pair" "naoki-tf-key" {
#     key_name = "naoki-tf2"
#     public_key = #naoki-tf-awsの公開鍵の中身を記入
# }


## EC2のインスタンス作成
resource "aws_instance" "naoki-instancetf" {
    ami = var.ami
    instance_type = var.instance-type
    disable_api_termination = false
    vpc_security_group_ids = [aws_security_group.naoki-ec2tf-sec.id]
    subnet_id = aws_subnet.public-a.id
    key_name = "naoki-tf-aws"

    root_block_device {
        volume_type = "gp2"
        volume_size = "8"
    }

    tags = {
        Name = "naoki-instancetf"
    }
}

## Elastic IPアドレスの割り当て
resource "aws_eip" "name" {
    instance = aws_instance.naoki-instancetf.id
    vpc = true
}
