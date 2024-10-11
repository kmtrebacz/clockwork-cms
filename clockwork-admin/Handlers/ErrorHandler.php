<?php

namespace Admin\Handlers;

use Pecee\Http\Request;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use \Exception;

class ErrorHandler implements IExceptionHandler
{
    public function handleError(Request $request, Exception $error): void
    {
        if ($request->getUrl()->contains('/api')) {
            response()->json([
                'error' => $error->getMessage(),
                'code'  => $error->getCode(),
            ]);
            return;
        }

        if ($error instanceof NotFoundHttpException) {
            response()->redirect('/clockwork-admin/dashboard?error=404'); // Redirect to your custom 404 page
            return;
        }

        response()->redirect('/clockwork-admin/dashboard?error=general&message=' . urlencode($error->getMessage()));
    }
}
