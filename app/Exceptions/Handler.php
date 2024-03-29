<?php

namespace IAServer\Exceptions;

use Exception;
use IAServer\Http\Controllers\Email\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $ip = Request::server('REMOTE_ADDR');
        $host = getHostByAddr(Request::server('REMOTE_ADDR'));
        $messageArray = array(
            "Exception" => $e->getFile(),
            "File" => get_class($this),
            "User" => (Auth::user()) ? Auth::user()->name : 'No logueado',
            "IP" => $ip,
            "Host" => $host,
            "Request Url" => Request::url(),
            "Code" => $e->getCode(),
            "Message" => $e->getMessage()
            //"Stack" => $e->getTraceAsString()
        );

        $messageOutput = "";
        foreach($messageArray as $key => $value){
            $messageOutput .= $key.' ---> '.$value."\n";
        }

        Log::error($messageOutput);

        if(
            $e instanceof \PDOException ||
            $e instanceof FatalErrorException
          )
        {
            return response()->view('errors.exception', ['mensaje'=>$e->getMessage()], 500);
        }

        if($e instanceof NotFoundHttpException)
        {
            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $e);
    }
}
