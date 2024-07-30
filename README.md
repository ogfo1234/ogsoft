To start project, run the following commands:

```bash
make start
```

## Onboarding backend 1

I created two endpoints based on Backend1.pdf

1. GET endpoint to demonstrate the use of the API. This enpodint is located on the path `/api/v1/simple-endpoint` and it returns a JSON object with the message `Hello World!`.
2. POST endpoint that accepts two parameters, `number1` and `number2`. It returns the sum of the two numbers. This endpoint is located on the path `/api/v1/simple-endpoint`.

Both endpoints are tested using the `unittest` module. Tests are focused to check API responses and status codes on different scenarios.

## Onboarding Database MySQL

I crated test database related to Database1.pdf (export is saved in `data/onboarding_database_dump.sql`). Dump should contain everything needed from PDF.

Exmaple of select using join:

```sql
SELECT o.*, u.username AS "Meno zákaznika"
FROM orders AS o
JOIN users AS u ON u.id = o.id_user
```

## Onboarding General 1

I created one enpoint based on General1.pdf

This endpoint is located on the path `/api/v1/working-day` and accept two parameters, one is requred (date) and second is optional (country). It returns a JSON object like this:

```json
{
    "is_working_day": false,
    "is_weekend":true,
    "is_holiday":false
}
```

## Onboarding General 2

I created one enpoint based on General2.pdf

This endpoint is located on the path `/api/v1/task`, Example of using this endpoint is `http://localhost:8000/api/v1/task?name=bruh&start_date=2024-07-29%2010:30:00&duration=1920&working_time_start=08:00&working_time_end=16:00&include_holidays=1` and accept five parameters. It returns a JSON object like this:

```json
{
    "due_date": {
        "date":"2024-08-02 10:30:00.000000",
        "timezone_type": 3,
        "timezone":"UTC"
    }
}
```