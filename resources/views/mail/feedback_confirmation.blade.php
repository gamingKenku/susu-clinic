<div class="container">
    <div class="row">
        <div class="col-md">
            <p>Спасибо за ваш отзыв! Перейдите по ссылке ниже для подтверждения.</p>
            <a class="btn btn-primary" href="{{ route('feedbackConfirm', [$feedback->id, $feedback->confirmation_token]) }}" role="button">Подтвердить</a>    
        </div>
    </div>
</div>
