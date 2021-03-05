## About Stonks Backend Service

 is a backend financial services that helps with the saving transfer and maintenance of users funds. This system is an api based system that processes users transactions and makes it easy for anyone to transfer save and withdraw money

Stonks Service is an accessible, powerful, and provides tools required for large, robust applications.

## Backend Application show case

[Click here to visit the Open API documentation](http://stonks-finance.herokuapp.com/api/docs).

- Transfer to another account via email addresses
- make deposits/ top ups
- process withdrawals
- enforce limits by accepting daily limits of 4 transaction based on action types
- View recent tranactions or preferably summary

## Features of the application

- Transfer to another account via email addresses
- make deposits/ top ups
- process withdrawals
- enforce limits by accepting daily limits of 4 transaction based on action types
- View recent tranactions or preferably summary


## How would you deploy the above on AWS?

i will carry out deployment ensuring the following:

1. AWS Auto Scaling and Load Balancing

2. Amazon S3 and CloudFront CDN

3. AWS RDS Aurora (managed database services)

4. Amazon VPC and Networking

5. Route53

6. AWS Lambda

7. Stateless applications and processes.

8. Dev, test and Production Parity.

9. Continuous Integration and Continuous Delivery – CI/CD


## Where do you see bottlenecks in your proposed architecture and how would you approach scaling this app starting from 100 reqs/day to 900MM reqs/day over 6 months?

1. Split out the Database Layer
2. Split Out the Clients usage. we can split it out so that we can handle scaling the service based on its own specific traffic patterns
3. Adding a Load Balancer.A load balancer also enables autoscaling. We can set up our load balancer to increase the number of instances during the Superbowl when everyone is online and decrease the number of instances when all of our users are asleep.
4. Providing a CDN. A CDN will automatically cache our images at different data centers throughout the world.
5. Scaling the Data Layer
6. Caching
7. Providing read replicas
8. Use a multi-AZ infrastructure for reliability.
9. Make use of self-scaling services like ELB, S3, SQS, SNS, DynamoDB, etc.



