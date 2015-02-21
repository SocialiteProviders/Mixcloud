<?php
namespace SocialiteProviders\Mixcloud;

use SocialiteProviders\Manager\SocialiteWasCalled;

class MixcloudExtendSocialite
{
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('mixcloud', __NAMESPACE__.'\Provider');
    }
}
