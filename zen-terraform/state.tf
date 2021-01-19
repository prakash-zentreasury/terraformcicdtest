terraform{
    backend "s3" {
        bucket = "leaseacc-dev-state"
        encrypt = false
        key = "terraform.tfstate"
        region = "eu-north-1"
    }
}

provider "aws" {
    region = "eu-north-1"
}