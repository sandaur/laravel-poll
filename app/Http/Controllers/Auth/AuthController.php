<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use InoOicClient\Flow\Basic;
use InoOicClient\Http;
use InoOicClient\Client;
use InoOicClient\Oic\Token;
use Exception;
use InoOicClient\Oic\Exception\ErrorResponseException;

class AuthController extends Controller {

    private function getAuthConfig(){
        return [
            'client_info' => [
                'client_id' => env('CU_CLIENT_ID'),
                'redirect_uri' => env('CU_REDIRECT_URL'),
                'authorization_endpoint' => 'https://www.claveunica.gob.cl/openid/authorize',
                'token_endpoint' => 'https://www.claveunica.gob.cl/openid/token',
                'user_info_endpoint' => 'https://www.claveunica.gob.cl/openid/userinfo',
                'authentication_info' => [
                    'method' => 'client_secret_post',
                    'params' => [
                        'client_secret' => env('CU_CLIENT_SECRET')
                    ]
                ]
            ]
        ];
    }

    public function something(){
        return "something";
    }

    public function requestOauth(Request $request) {
        $flow = new Basic($this->getAuthConfig());
        if (!$request->has('redirect')):
            try{
                $uri = $flow->getAuthorizationRequestUri('openid run name');
                return redirect($uri);
            } catch (Exception $e) {
                printf("Exception during authorization URI creation: [%s] %s", get_class($e), $e->getMessage());
            }
        else:
            try {
                $userInfo = $flow->process();
            } catch (Exception $e) {
                printf("Exception during user authentication: [%s] %s", get_class($e), $e->getMessage());
            }
        endif;
    }

    public function responseOauth(Request $request) {
        try{
            $flow = new Basic($this->getAuthConfig());
            $token = $flow->getAccessToken($request->input('code'));
            $infoPersonal = $flow->getUserInfo($token);

            dd($infoPersonal);

            $rut = "{$infoPersonal['RolUnico']['numero']}-{$infoPersonal['RolUnico']['DV']}";
            /* $user = User::firstOrNew(['rut' => $rut]);
            $user->rut = $rut;
            $user->name = implode(' ', $infoPersonal['name']['nombres']) . ' ' . implode(' ', $infoPersonal['name']['apellidos']);
            $user->password = $infoPersonal['sub'];
            $user->save(); */


            //Auth::login($user);

            return redirect()->to('home');
        }catch(ErrorResponseException $e){
            return redirect()->to('/');
        }
    }
}
