# minecraft-sms-sistema
minecraft sms sistema skirta minehost.lt

Result json format

Support only https request to main server.

Example to get all services:
https://minehost.lt/sms/user-id/service-id/services

Result:

```
{
  "services": [
    {
      "1": {
        "id": "21139",
        "title": "",
        "service": "OP",
        "price_lt": "8",
        "price_eur": 2.32,
        "about": "OP",
        "p1": null,
        "p2": null,
        "p3": null,
        "p4": null,
        "p5": null,
        "p6": null,
        "p7": null,
        "p8": null,
        "p9": null,
        "p10": null
      }
    },
    {
      "2": {
        "id": "23687",
        "title": "",
        "service": "gfhgfh",
        "price_lt": "1",
        "price_eur": 0.29,
        "about": "gfh",
        "p1": null,
        "p2": null,
        "p3": null,
        "p4": null,
        "p5": null,
        "p6": null,
        "p7": null,
        "p8": null,
        "p9": null,
        "p10": null
      }
    }
  ],
  "count": 2
}
```
