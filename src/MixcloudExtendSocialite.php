<?php
namespace SocialiteProviders\Mixcloud;

use SocialiteProviders\Manager\SocialiteWasCalled;

class MixcloudExtendSocialite
{
    /**
     * Execute the provider.
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'mixcloud', __NAMESPACE__.'\Provider'
        );
    }
}
