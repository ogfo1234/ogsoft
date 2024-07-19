To start project, run the following commands:

```bash
make start
```

## Onboarding backend 1

I created two endpoints based on Backend1.pdf

1. GET endpoint to demonstrate the use of the API. This enpodint is located on the path `/api/v1/simple-endpoint` and it returns a JSON object with the message `Hello World!`.
2. POST endpoint that accepts two parameters, `number1` and `number2`. It returns the sum of the two numbers. This endpoint is located on the path `/api/v1/simple-endpoint`.

Both endpoints are tested using the `unittest` module. Tests are focused to check API responses and status codes on different scenarios.