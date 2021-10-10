resource "aws_s3_bucket" "bucket1" {
    bucket = "naoki-tf-bucket"
    acl = "private"
}
