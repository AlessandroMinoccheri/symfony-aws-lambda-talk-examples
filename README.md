# Symfony-aws-lambda-talk-examples

This is an example of usage of Symfony deployed on a Lambda.

To init the projhect you need to launch from your CLI:


Is recommended to use a PHP version >=7.2

You need to have an Amazon account with an access key ID and a secret access key.


```
composer install
npm install -g serverless
serverless config credentials — provider aws — key <key> — secret <secret>
```

Inside serverless config command you need to substitute key and secret with yours.
Now you need to configure your environment variables inside SSM parameter store or via browser inside AWS dashboard or launching this command for example:

```
aws ssm put-parameter — region us-central -1 — name ‘/my-app/MY_CUSTOM_ENV_VARIABLES’ — type String — value ‘this is my custom env variables’
```

Next step is to launch bref intialization:

```
./vendor/bin/bref init
```

Now, you need to update serverless.yml file with your custom information if you need it.

To deploy you have only to optimize dependencies and deploy.

```
composer install --optimize-autoloader --no-dev
serverless deploy
```

