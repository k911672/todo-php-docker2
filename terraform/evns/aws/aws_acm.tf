## ACMの設定
resource "aws_acm_certificate" "naoki-acmtf" {
    domain_name       = "naoki-tf.fun"
    subject_alternative_names = ["*.naoki-tf.fun"]
    validation_method = "DNS"

    tags = {
        Name = "naoki-acmtf"
    }

    lifecycle { 
        create_before_destroy = true 
    }
}

# ACM証明書とRoute53のCHAMEレコードとの紐付け
resource "aws_acm_certificate_validation" "naoki-acmtf-validation" {
    certificate_arn         = aws_acm_certificate.naoki-acmtf.arn
    validation_record_fqdns = [aws_route53_record.naoki_record-acmtf.fqdn]
}
