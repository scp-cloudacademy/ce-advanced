# 1. Create Object Storage

### Request Object Storage

    Bucket Name: ceweb
    Access Control: {Your PC's Public IP address (This is for lab)}

# 2. Download and upload web source to bucket

### Download [web source](https://github.com/scp-cloudacademy/ce-advanced/blob/main/23/web.zip) and extract.

### Upload sources to bucket using [AWS CLI](https://aws.amazon.com/ko/cli/)

    aws configure
      AWS Access Key ID: {Object Storage Credential Access key}
      AWS Secret Access Key: {Object Storage Credential Secret key}
    aws s3 cp . s3://ceweb/ --endpoint-url {Object Storage Public endpoint} --recursive

### Edit permission of file and folder to allow public access

### Open url of index.html at browser.

# 3. Create Cloud Functions

### Request Cloud Functions

    Function Name: cecfpy311
    Endpoint | Public endpoint access control : {Your PC's Public IP address}
    Runtime: Python 3.11
        
### Configure the belows after creation

- Trigger: API Gateway
- Env
   Environment
    |Name|Value|
    |:----------:|:-----------------------------:|
    |cename|Cosmetic Evolution|
    |cemail|marketing@cosmetic-evolution.net|
- Code
```
import json
import requests
import os

def handle_request(params):
    body = params.json
    name = os.environ.get("cename") ; 
    email = os.environ.get("cemail") ; 
    response_message = "Your Feedback -" + body.get('message') + "- was successfully submitted. Feel free to contact " + name + "(" + email + "), if you have any questions!"
    return {
        'statusCode': 200,
        'body': response_message
    }

```
# 4. Create API Gateway
### Request API Gateway service
    API Gateway name: api 

### Create API
    API name: message
    Context: message
    Version: v1
    Endpoint: Cloud Functions
    Endpoint Security: Non security
    CORS Activation: check Use
    URL pattern: /
                 check POST
                 use certification: Non certification
                 Parameter
                     name: body
                     Parameter type: body
                     Datatype: string


                     
    


