resource "local_file" "kubeconfig" {
    content  = local.kubeconfig
    filename = "kubeconfigs.yaml"
}

resource "local_file" "aws_auth" {
    content  = local.config_map_aws_auth
    filename = "aws-auth.yaml"
}
