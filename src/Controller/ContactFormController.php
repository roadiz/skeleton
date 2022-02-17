<?php

declare(strict_types=1);

namespace App\Controller;

use RZ\Roadiz\CoreBundle\Mailer\ContactFormManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactory;

final class ContactFormController
{
    private ContactFormManager $contactFormManager;
    private RateLimiterFactory $contactFormLimiter;

    public function __construct(
        ContactFormManager $contactFormManager,
        RateLimiterFactory $contactFormLimiter
    ) {
        $this->contactFormManager = $contactFormManager;
        $this->contactFormLimiter = $contactFormLimiter;
    }

    public function formAction(Request $request): Response
    {
        $limiter = $this->contactFormLimiter->create($request->getClientIp());
        $limit = $limiter->consume();
        $headers = [
            'X-RateLimit-Remaining' => $limit->getRemainingTokens(),
            'X-RateLimit-Retry-After' => $limit->getRetryAfter()->getTimestamp(),
            'X-RateLimit-Limit' => $limit->getLimit(),
        ];
        if (false === $limit->isAccepted()) {
            throw new TooManyRequestsHttpException($limit->getRetryAfter()->getTimestamp());
        }

        // Do not forget to disable CSRF and form-name
        $this->contactFormManager
            ->setUseRealResponseCode(true)
            ->setFormName('')
            ->disableCsrfProtection();
        /*
         * Do not call form builder methods BEFORE defining options.
         */
        $this->contactFormManager
            ->withDefaultFields()
            ->withUserConsent()
            ->withGoogleRecaptcha('g-recaptcha-response')
        ;

        if (null !== $response = $this->contactFormManager->handle()) {
            $response->headers->add($headers);
            return $response;
        }
        throw new BadRequestHttpException('Form has not been submitted.');
    }
}
