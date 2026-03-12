# OpenCampaigns Magento 2 Protocol Module

A native Magento 2 module serving the `OpenCampaigns_Protocol` configuration. Allow Magento merchants to plug straight into decentralized advertising frameworks without intermediation.

## Architecture

* **System Store Configuration**: Admin section configuring publisher metadata, auto-generating Nostr Schnorr keypairs locally.
* **Well-Known Controller**: Defines the native `/.well-known/opencampaigns.json` interface serving static JSON manifests securely over HTTPS without overhead.
* **Data Providers**: Integrates with Magento 2's Catalog Price Rules to export large-scale targeted sale discounts explicitly into Nostr relays as offers, tracking affiliate IDs across checkouts.

## License
MIT
