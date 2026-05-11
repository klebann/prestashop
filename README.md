# Prestashop Project

## 📌 Scope

The project consists of two main parts:

### 1. Header (theme customization)
- Implementation of a header layout based on the provided UI design:
  https://xd.adobe.com/view/87274cd6-ec0f-4b99-8bde-1ba62337cc17-d274/
- Built on top of the `classic` PrestaShop theme
- Focus on layout structure, positioning, and approximate styling rather than pixel-perfect reproduction

### 2. Shipping module

- Custom module `lowestShippingPrice`
- Displays the lowest available shipping cost on the product page
- Takes into account PrestaShop shipping configuration (carriers, zones, weight/price ranges, etc.)
- Implementation in progress

---

## 🚀 Run

```bash
docker-compose up -d