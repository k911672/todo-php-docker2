## Route53の作成
resource "aws_route53_zone" "naoki-route53tf" {
    name = "naoki-tf.fun"
}


# ACMのCNAMEをRoute53登録
resource "aws_route53_record" "naoki_record-acmtf" {
    name = "_ae2733c0a746fad6adb150a97b5d2ee6.naoki-tf.fun."
    records = ["_8477f7585e56d2f955a6a391524706ba.mvtxpqxpkb.acm-validations.aws."]
    ttl = 60
    type = "CNAME"
    zone_id = aws_route53_zone.naoki-route53tf.zone_id
    allow_overwrite = true
}

## Route53にALBのDNS追加
resource "aws_route53_record" "naoki-route53tf-alb" {
    zone_id = aws_route53_zone.naoki-route53tf.zone_id
    name = aws_route53_zone.naoki-route53tf.name
    type = "A"

    alias {
        name = "dualstack.${aws_alb.naoki-albtf.dns_name}"
        zone_id = aws_alb.naoki-albtf.zone_id
        evaluate_target_health = true
    }
    allow_overwrite = true
}
