# Finance API

## Features

- Importing bank transactions
- Creating a ledger with eloquent-simple-ledger
- Extensive api controls with laravel-query-builder

## Installation

- Clone Repo
- `composer install`
- Enter env USER_NAME and USER_EMAIL
- Enter the last balance amount in LAST_BALANCE *
- `php artisan migrate && db:seed`

---
**Filling LAST_BALANCE**

The LAST_BALANCE value should be a integer in cents.
When filling the transactions through the import, the last balance should be the account balance before the first mutation in the import file.

Example:
First record in import is a credit of EUR 1,85 and balance after that transaction is EUR 382,42:

```
328,42 + 1,85 = 330,27

LAST_BALANCE = 33027

```

---

### Importing transactions from csv (Rabobank only)

- Save imported transactions to `storage/app`
- `php artisan transactions:import {filename.csv}`

## Requesting data

Example request : `GET api/transactions?&filter[transaction_date_after]=2017-09-27`

More complex request: `GET api/account/1/ledgers?include=transaction&fields[account_ledgers]=desc,balance,id&fields[transaction]=account_ledger_id,iban&sort=-balance&append=format-balance`

Output: 

```
[
    {
        "desc": "...",
        "balance": 290528,
        "id": ...,
        "format-balance": "€ 2.905,28",
        "transaction": {
            "account_ledger_id": ...,
            "iban": "..."
        }
    },
    {
        "desc": "...",
        "balance": 290528,
        "id": ...,
        "format-balance": "€ 2.900,28",
        "transaction": {
            "account_ledger_id": ...,
            "iban": "..."
        }
    },
    ....
]

```
The allowed includes, filters, sorts and appends are defined in the controllers.

## Creating new Controllers with QueryBuilder support


@Todo

- Implement rabobank api
-