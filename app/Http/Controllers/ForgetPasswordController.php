<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\ForgotPassword;
use App\User;

class ForgetPasswordController extends Controller
{

    function getView($link, Request $request){
        if($request->isMethod('post')){
            if(!$request->password or !$request->repass){
                return redirect()->back()->with('err-message', 'Password fields are required!');
            }
            if($request->password != $request->repass){
                return redirect()->back()->with('err-message', 'Password fields should match!');
            }
            $user = User::where('email', $request->email)->get();
            if(!$user->first()){
                return redirect()->back()->with('err-message', 'E-mail address was not found!');
            }
            if($request->password == $request->repass){
                User::where('email', $request->email)
                    ->update(['password' => bcrypt($request->password)]);
                ForgotPassword::where('email', $request->email)->delete();
            }
            return redirect()->to('reset-password/success');
        }
        $linkCheck = ForgotPassword::where('link', $link)->get();
        if($linkCheck->first()){
            return view('forgot-password', [
                'email' => $linkCheck[0]['email'],
                'link' => $link
            ]);
        }else{
            return 'This link doesn\'t exist';
        }
    }

    function requestResetPassword(Request $request){

        if(!$request->email){
            return Response::json([
                'status' => 'false',
                'message' => 'No email found!'
            ]);
        }

        $mailCheck = User::where('email', $request->email)->get();
        if(!$mailCheck->first()){
            return Response::json([
                'status' => 'false',
                'Message' => 'Wrong email address!'
            ]);
        }

        $reqCheck = ForgotPassword::where('email', $request->email)->get();
        if($reqCheck->first()){
            return Response::json([
                'status' => 'false',
                'message' => 'An email with password reset link has been sent to you already!'
            ]);
        }

        $linkExtension = $this->generateRandomString();
        $link = url('/api/v1/forgot-password').'/'.$linkExtension;
        
        $transport = (new \Swift_SmtpTransport('ssl://mail.gotguide.info', 465))
                ->setUsername("forgetpassword@gotguide.info")
                ->setPassword('fpgg@&17');

            $mailer = new \Swift_Mailer($transport);

            $message = new \Swift_Message('Got Guide - Password Reset Link');
            $message->setFrom(['forgetpassword@gotguide.info' => 'Admin - Got Guide']);
            $message->setTo([$request->email => $mailCheck[0]['name']]);
            $message->setBody('<html><body>'.
                '<h1>Hi '.$mailCheck[0]['name'].',</h1>'.
                '<p style="font-size:18px;">You recently requested to reset your password. Please click the button/link below to reset.</p>'.
                '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              <div>
                                <!--[if mso]>
                                  <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://litmus.com" style="height:36px;v-text-anchor:middle;width:150px;" arcsize="5%" strokecolor="#EB7035" fillcolor="#EB7035">
                                    <w:anchorlock/>
                                    <center style="color:#ffffff;font-family:Helvetica, Arial,sans-serif;font-size:16px;">I am a button &rarr;</center>
                                  </v:roundrect>
                                <![endif]-->
                                <a href="'.$link.'" style="background-color:#EB7035;border:1px solid #EB7035;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">Reset password &rarr;</a>
                              </div>
                            </td>
                          </tr>
                        </table>'.
                '<br><br>Thank You<br>Got Guide<br>Customer Care Team</body></html>',
                'text/html');

            $result = $mailer->send($message);

        $genLink = new ForgotPassword();

        $genLink->email = $request->email;
        $genLink->link = $linkExtension;

        $genLink->save();

        return Response::json([
            'status' => 'true',
            'email' => $request->email,
            'message' => 'An email containing password reset link has been sent to your email address'
        ]);
    }

    function processResetPassword(Request $request){
        if(!$request->password or !$request->repass){
            return view('messages', ['message' => 'Password field is required!']);
        }
        if($request->password != $request->repass){
            return view('messages', ['message' => 'Password fields should match!']);
        }
        $user = User::where('email', $request->email)->get();
        if(!$user->first()){
            return view('messages', ['message' => 'E-mail address was not found!']);
        }
        if($request->password == $request->repass){
            User::where('email', $request->email)
                ->update(['password' => bcrypt($request->password)]);
            ForgotPassword::where('email', $request->email)->delete();
        }
        return view('messages', ['message' => 'Your password has been reset. Try login now.'."\n".'Thank you!']);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function webForgetPassword(Request $request){
        if($request->isMethod('post')){
            if(!$request->email){
                return redirect()->back()->with('err-message', 'Please provide an email!');
            }

            $mailCheck = User::where('email', $request->email)->get();
            if(!$mailCheck->first()){
                return redirect()->back()->with('err-message', 'Wrong email address!');
            }

            $reqCheck = ForgotPassword::where('email', $request->email)->get();
            if($reqCheck->first()){
                return redirect()->back()->with('err-message', 'An email with password reset link has been sent to you already!');
            }

            $linkExtension = $this->generateRandomString();
            $link = url('/api/v1/forgot-password').'/'.$linkExtension;
        
        $transport = (new \Swift_SmtpTransport('ssl://mail.gotguide.info', 465))
                ->setUsername("forgetpassword@gotguide.info")
                ->setPassword('fpgg@&17');

            $mailer = new \Swift_Mailer($transport);

            $message = new \Swift_Message('Got Guide - Password Reset Link');
            $message->setFrom(['forgetpassword@gotguide.info' => 'Admin - Got Guide']);
            $message->setTo([$request->email => $mailCheck[0]['name']]);
            $message->setBody('<html><body>'.
                '<h1>Hi '.$mailCheck[0]['name'].',</h1>'.
                '<p style="font-size:18px;">You recently requested to reset your password. Please click the button/link below to reset.</p>'.
                '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              <div>
                                <!--[if mso]>
                                  <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://litmus.com" style="height:36px;v-text-anchor:middle;width:150px;" arcsize="5%" strokecolor="#EB7035" fillcolor="#EB7035">
                                    <w:anchorlock/>
                                    <center style="color:#ffffff;font-family:Helvetica, Arial,sans-serif;font-size:16px;">I am a button &rarr;</center>
                                  </v:roundrect>
                                <![endif]-->
                                <a href="'.$link.'" style="background-color:#EB7035;border:1px solid #EB7035;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">Reset password &rarr;</a>
                              </div>
                            </td>
                          </tr>
                        </table>'.
                '<br><br>Thank You<br>Got Guide<br>Customer Care Team</body></html>',
                'text/html');

            $result = $mailer->send($message);

            $genLink = new ForgotPassword();

            $genLink->email = $request->email;
            $genLink->link = $linkExtension;

            $genLink->save();

            return redirect()->to('forget-password/success');
        }
        $result = new \stdClass();
        $result->header = 'includes.forget-pass-header';
        return view('pages.forget-pass', ['result' => $result]);
    }

    public function webForgetPasswordSuccess(Request $request){
        $result = new \stdClass();
        $result->header = 'includes.forget-pass-header';
        $result->message = 'Password reset link email has been send to your email address.';
        return view('pages.forget-pass-success', ['result' => $result]);
    }
    
    public function webResetPasswordSuccess(Request $request){
        $result = new \stdClass();
        $result->header = 'includes.forget-pass-header';
        $result->message = 'Your password has been reset. Try login now.'."\n".'Thank you!';
        return view('pages.forget-pass-success', ['result' => $result]);
    }

}
