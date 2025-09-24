# SprykerCommunity SSP AssetNotification Integration Guide

This README provides step-by-step instructions to integrate the SprykerCommunity AssetNotification module into your Spryker B2B Demo Shop.

## Prerequisites

1. Spryker B2B Demo Shop installed and running
2. Git access to clone the dummy module
3. Composer installed

## Workflow

### Set up a place for packagable modules to work on

1. Create local-packages Directory

Create a local-packages directory in your demo shop root:

```bash
mkdir local-packages
cd local-packages
```

2. Adjust .gitignore of demo-shop

Add the module directory to your main project's .gitignore file to prevent tracking the module as part of the main project:

```
# Add to .gitignore
/local-packages/
```

### Install the Dummy Module

1. Clone Dummy Module

Clone the dummy module repository into the module directory:

```bash
git clone git@github.com:spryker-community/dummy-module.git dummy-module
```

Your directory structure should now look like:

```text
b2b-demo-shop/
├── local-packages/
│   └── dummy-module/
│       ├── assets/
│       │   ├── Zed/
│       │   │   └── package.json
│       │   └── package.json
│       └── src/
│           └── SprykerCommunity/
│               └── Zed/
│                   └── DummyModule/
├── src/
├── vendor/
└── composer.json
```

2. Update Main Project composer.json

Add the path repository configuration to your main project's composer.json:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "local-packages/dummy-module",
            "options": {
                "symlink": true
            }
        }
    ],
}
```

3. Install the Module

Run the composer require command from your demo shop root directory:

```bash
composer require spryker-community/dummy-module:@dev
```

### Make your project aware of Spryker Community

#### Sprykers Autoloading (PHP-side)

1. Configure Spryker Core Namespaces

Add the SprykerCommunity namespace to your Spryker configuration:

File: `config/Shared/config_default.php`

```php
<?php

// Add SprykerCommunity to the core namespaces array
$config[KernelConstants::CORE_NAMESPACES] = [
    'SprykerCommunity',  // Add this line
    'SprykerShop',
    'SprykerEco',
    'Spryker',
    'SprykerSdk',
];
```

2. Clear Cache (Optional)

If needed, clear the Spryker cache:

```bash
vendor/bin/console cache:empty-all
```

#### Node Modules

1. Add the `spryker-community` workspace to the root `package.json` of your project:

```
"workspaces": [
   "vendor/spryker/*",
   "vendor/spryker-community/*",
   "vendor/spryker-community/*/assets/",
   "vendor/spryker/*/assets/Zed",
   "vendor/spryker-community/*/assets/Zed"
],
```

2. Install all JavaScript dependencies from the `/vendor/spryker-community` directory and compile them for use in your application:

Note: Execute inside your `docker/sdk cli`
```bash
npm install
```

With `ls -la node_modules` you should see that we installed the node modules `dummy-package-tsl` and `hello-world-npm`.


### Verification

After successful installation, you should be able to access the test module at:
http://backoffice.eu.spryker.local/dummy-module

---

## AssetNotification Module

The AssetNotification module is a SprykerCommunity extension that provides asset maintenance notification functionality for the Self-Service Portal (SSP) in Spryker B2B Demo Shop. This module allows users to set up maintenance notifications for their assets with configurable intervals.

### Features

- **Asset Maintenance Notifications**: Create and manage maintenance notifications for SSP assets
- **Configurable Intervals**: Set custom service intervals for asset maintenance
- **Integration with SSP**: Seamlessly integrates with the existing Self-Service Portal asset management
- **Frontend Integration**: Provides frontend components for displaying asset maintenance information
- **Database Persistence**: Stores notification data with proper foreign key relationships to assets

### Integration Points

- Integrates with the Self-Service Portal asset management system
- Uses Spryker's standard transfer object system
- Follows Spryker's module architecture patterns
- Provides frontend templates for asset maintenance display

### Required Spryker Overrides

To make the AssetNotification module work, you need to override two classes in your project:

#### 1. SspAssetTabs Override

Create `src/Pyz/Zed/SelfServicePortal/Communication/Asset/Tabs/SspAssetTabs.php`:

```php
<?php

namespace Pyz\Zed\SelfServicePortal\Communication\Asset\Tabs;

use Generated\Shared\Transfer\TabItemTransfer;
use SprykerFeature\Zed\SelfServicePortal\Communication\Asset\Tabs\SspAssetTabs as SprykerSspAssetTabs;
use Generated\Shared\Transfer\TabsViewTransfer;

class SspAssetTabs extends SprykerSspAssetTabs
{
    protected function build(TabsViewTransfer $tabsViewTransfer): TabsViewTransfer
    {
        $this->addCompaniesTab($tabsViewTransfer);
        $this->addSspInquiriesTab($tabsViewTransfer);
        $this->addSspServicesTab($tabsViewTransfer);
        $this->addAttachedFilesTab($tabsViewTransfer);
        $this->addNotificationTab($tabsViewTransfer);

        return $tabsViewTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return $this
     */
    protected function addNotificationTab(TabsViewTransfer $tabsViewTransfer)
    {
        $tabItemTransfer = (new TabItemTransfer())
            ->setName('notification')
            ->setTitle('Notification')
            ->setTemplate('@AssetNotification/_partials/_tabs/tab-notification.twig');

        $tabsViewTransfer->addTab($tabItemTransfer);

        return $this;
    }
}
```

#### 2. SelfServicePortalCommunicationFactory Override

Create `src/Pyz/Zed/SelfServicePortal/Communication/SelfServicePortalCommunicationFactory.php`:

```php
<?php

namespace Pyz\Zed\SelfServicePortal\Communication;

use Pyz\Zed\SelfServicePortal\Communication\Asset\Tabs\SspAssetTabs;
use SprykerFeature\Zed\SelfServicePortal\Communication\SelfServicePortalCommunicationFactory as SprykerSelfServicePortalCommunicationFactory;

class SelfServicePortalCommunicationFactory extends SprykerSelfServicePortalCommunicationFactory
{
    public function createSspAssetTabs(): SspAssetTabs
    {
        return new SspAssetTabs();
    }
}
```

These overrides add a "Notification" tab to the SSP asset management interface and ensure the custom tab implementation is used.
