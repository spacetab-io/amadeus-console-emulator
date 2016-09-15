<?php

namespace App\Classes;

use Amadeus\Client;
use Amadeus\Client\Params;
use Amadeus\Client\Params\AuthParams;
use Amadeus\Client\RequestOptions\CommandCrypticOptions;
use Amadeus\Client\Result;
use Amadeus\Client\Session\Handler\InvalidSessionException;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Cryptic
{

    private $client;

    public function __construct()
    {
        $authParams = new AuthParams([
                'officeId'       => getenv('OFFICE_ID'),
                //The Amadeus Office Id you want to sign in to - must be open on your WSAP.
                'userId'         => getenv('USER_ID'),
                //Also known as 'Originator' for Soap Header 1 & 2 WSDL's
                'passwordData'   => getenv('PASSWORD_HASH'),
                // **base 64 encoded** password
                'passwordLength' => getenv('PASSWORD_LENGTH'),
                'dutyCode'       => getenv('DUTY_CODE'),
                'organizationId' => getenv('ORGANIZATION'),
            ]
        );

        // the default date format is "Y-m-d H:i:s"
        $dateFormat = "Y n j, g:i a";
        // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
        $output = "%datetime% > %level_name% > %message% %context% %extra%\n";
        // finally, create a formatter
        $formatter = new LineFormatter($output, $dateFormat);

        // Create a handler
        $stream = new StreamHandler(BASE_PATH . '/logs/app.log', constant('Monolog\Logger::'.strtoupper(getenv('LOG_LEVEL'))));
        $stream->setFormatter($formatter);
        // bind it to a logger object
        $securityLogger = new Logger('Amadeus WS logs');
        $securityLogger->pushHandler($stream);

        $params = new Params([
                'sessionHandlerParams' => [
                    'soapHeaderVersion' => Client::HEADER_V2,
                    //Points to the location of the WSDL file for your WSAP. Make sure the associated XSD's are also available.
                    'wsdl'              => BASE_PATH . '/WSDL/'.getenv('WSDL_NAME'),
                    'logger'            => $securityLogger
                ],
                'authParams'           => $authParams,
                'requestCreatorParams' => [
                    'receivedFrom' => 'ws client test project'
                    // The "Received From" string that will be visible in PNR History
                ],
            ]
        );

        $this->client = new Client($params);

        $this->authenticate();
    }

    public function passEntry($entry)
    {
        $opt = new CommandCrypticOptions([
                'entry' => $entry
            ]
        );

        return $this->client->commandCryptic($opt);
    }

    private function authenticate()
    {
        $authResult = $this->client->securityAuthenticate();

        if ($authResult->status === Result::STATUS_OK) {
        } else {
            throw new InvalidSessionException('Auth is invalid!');
        }
    }
}