## ALBの設定
resource "aws_alb" "naoki-albtf" {
    name = "naoki-albtf"
    subnets = [aws_subnet.public-a.id, aws_subnet.public-c.id]
    security_groups = [aws_security_group.naoki-albtf-sec.id]
    internal = false
    enable_deletion_protection = false

    tags = {
        Name = "naoki-albtf"
    }
}

## ターゲットグループの追加
resource "aws_alb_target_group" "naoki-albtf-target" {
    name = "naoki-albtf-target"
    port = 80
    protocol = "HTTP"
    vpc_id = aws_vpc.naoki-wptf-vpc.id

    health_check {
        port = "80"
        path = "/"
        healthy_threshold = "5"
        unhealthy_threshold = "2"
        timeout = "5"
        interval = "30"
        matcher = "200"
    }
}

resource "aws_alb_target_group_attachment" "naoki-albtf-target" {
    target_group_arn = aws_alb_target_group.naoki-albtf-target.arn
    target_id = aws_instance.naoki-instancetf.id
    port = "80"
}

## リスナーの追加
resource "aws_alb_listener" "naoki-albtf-listener80" {
    load_balancer_arn = aws_alb.naoki-albtf.arn
    port = "80"
    protocol = "HTTP"

    default_action {
        target_group_arn = aws_alb_target_group.naoki-albtf-target.arn
        type = "forward"
    }
}

resource "aws_alb_listener" "naoki-albtf-listener443" {
    load_balancer_arn = aws_alb.naoki-albtf.arn
    port = "443"
    protocol = "HTTPS"
    ssl_policy = "ELBSecurityPolicy-2016-08"
    certificate_arn = aws_acm_certificate.naoki-acmtf.arn

    default_action {
        target_group_arn = aws_alb_target_group.naoki-albtf-target.arn
        type = "forward"
    }
}

## リスナーのルール
resource "aws_alb_listener_rule" "naoki-albtf-listener" {
    listener_arn = aws_alb_listener.naoki-albtf-listener80.arn
    priority = "100"

    action {
        type = "forward"
        target_group_arn = aws_alb_target_group.naoki-albtf-target.arn
    }

    condition {
        path_pattern {
            values = ["/wp-login.php", "/wp-admin/*"]
        }
    }
}
