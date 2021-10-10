provider "aws" {
    shared_credentials_file = "/.aws/credentials"
    region = "ap-northeast-1"
    profile = "menta-tf"
    version = "~> 3.0"
}

//S3バケットを作成してからじゃないと動作しない
terraform {
    required_version = "1.0.3"
    backend "s3" {
        bucket = "naoki-tf-bucket"
        profile = "menta-tf"
        key = "./.terraform/terraform.tfstate"
        region = "ap-northeast-1"
        encrypt = true
    }
}
