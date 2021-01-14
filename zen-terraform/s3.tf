resource "aws_s3_bucket" "codepipeline_artifacts" {
  bucket = "pipeline-artifacts-aghori822"
  acl    = "private"

  tags = {
    "Name" = "DEV-S3-stage"
    "Env"  = "dev"
  }
}