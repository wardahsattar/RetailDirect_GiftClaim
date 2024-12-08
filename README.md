# RetailDirect GiftClaim Module for Magento 2  

The **RetailDirect_GiftClaim** module allows customers to claim a gift product after placing an order. Customers provide details like IMEI, Name, Email, Phone, and Address through a user-friendly form. The system verifies the IMEI and OTP to complete the claiming process.  

---

## Features  
- **Claim Gift After Order**: Customers can claim a gift via a form on the order success page.  
- **IMEI Verification**: Verifies the IMEI from the database.  
- **OTP Verification**: Sends a one-time password (OTP) to the customer's email for verification.  
- **Admin IMEI Management**: Admin can manage IMEI entries via a grid in the admin dashboard.  

---

## Installation  

### Prerequisites  
- Magento 2.4.7  
- PHP 8.1  
- MailHog (for testing emails in local development, available via Warden: [Warden Docs](https://docs.warden.dev/))  

### Steps  
1. **Clone the repository or download the zip file:**

   - **Using Git Clone:**
     ```bash
     git@github.com:wardahsattar/RetailDirect_GiftClaim.git app/code/
     ```
   - **Download as Zip:**
     - Download the zip file from the repository.
     - Unzip and extract it to `app/code/RetailDirect/GiftClaim`.

### 2. Run Magento installation commands

After cloning or extracting the module, navigate to the root directory of your Magento installation and run the following commands to install the module:

#### Step 1: Upgrade the setup

```bash
bin/magento setup:upgrade
```

#### Step 2: Compile the dependency injection configurations

```bash
bin/magento setup:di:compile
```

#### Step 3: Flush the cache

```bash
bin/magento cache:flush
```

## Usage

### Customer Workflow  

1. After placing an order, customers will see a **Claim Your Gift** button on the success page.  
2. Clicking the button redirects them to the **Claim Gift Form**, where they input:  
   - IMEI  
   - Name  
   - Email  
   - Phone  
   - Address  
3. The system checks the IMEI from the database:  
   - If valid, an OTP is sent to the customer's email.  
4. The customer inputs the OTP on the verification form.  
5. Once verified:  
   - The IMEI is marked as claimed.  
   - A success message is displayed.  

### Admin Workflow  

1. Navigate to **RetailDirect > GiftClaim** in the Magento admin dashboard.  
2. View the list of all gift claims in a grid.  
3. Add new IMEI entries by providing:  
   - IMEI  
   - Tracking Number  

## Technical Details

### Database Schema

The module uses a custom database table: `retaildirect_giftclaim_giftclaim`.

#### Table Description:  

| Column            | Description                                       |  
|-------------------|---------------------------------------------------|  
| `imei`            | IMEI number of the product                       |  
| `name`            | Customer's name (populated after OTP verification) |  
| `email`           | Customer's email (populated after OTP verification) |  
| `phone`           | Customer's phone number (populated after OTP verification) |  
| `created_at`      | Record creation date                             |  
| `updated_at`      | Record update date                               |  
| `is_claimed`      | Flag indicating if the IMEI is claimed (1 = Yes) |  
| `claim_date`      | Date of claim                                    |  
| `tracking_number` | Tracking number added by the admin               |  


### OTP Functionality

1. A random 6-digit OTP is generated.
2. OTP is sent to the customer's email.
3. OTP is stored in the session for verification.

### Email Testing

The module is tested with` MailHog`, a gloabl email service provided by Warden [Warden Docs](https://docs.warden.dev/)

### License

This project is licensed under the MIT License. See the LICENSE file for more details.


