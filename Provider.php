<?php

namespace SocialiteProviders\Mixcloud;

use GuzzleHttp\RequestOptions;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider
{
    public const IDENTIFIER = 'MIXCLOUD';

    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase('https://www.mixcloud.com/oauth/authorize', $state);
    }

    protected function getTokenUrl(): string
    {
        return 'https://www.mixcloud.com/oauth/access_token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://api.mixcloud.com/me/', [
            RequestOptions::QUERY => [
                'access_token' => $token,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id'     => null, 'nickname' => $user['username'],
            'name'   => $user['name'], 'email' => null,
            'avatar' => $user['pictures']['large'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function user()
    {
        $user = $this->mapUserToObject($this->getUserByToken(
            $token = $this->parseAccessToken($this->getAccessTokenResponse($this->getCode()))
        ));

        return $user->setToken($token);
    }
}
