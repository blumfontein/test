The Application is REST API only

#### API reference:

- POST /client - create client
- PATCH /client/{id} - update client
- POST /credits/{credit_id}/scoring/{client_id} - check is client is allowed to apply credit
- POST /credits/{credit_id}/issuance/{client_id} - issue credit to a client

#### Build and test

To build container and run tests

```bash
docker-compose up --build
```
