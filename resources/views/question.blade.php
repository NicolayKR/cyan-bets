@extends('layouts.app')

@section('title', 'Вопросы и ответы')

@section('content')
<div class="row justify-content-center">
    <allert-paid></allert-paid>
    <div class="py-4 col-md-10 px-md-4">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingNull">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseNull" aria-expanded="false" aria-controls="panelsStayOpen-collapseNull">
                        Когда я смогу воспользоваться стратегиями? Как мне понять какие объекты стоит самому продвигать?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseNull" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingNull">
                    <div class="accordion-body">
                    Для использования автоматической стратегии, потребуется анализ показателей на ЦИАН всей Вашей базы объектов. Обычно, это занимает 2-3 недели.<br>
                    Однако советы по поднятию будут доступны уже через 5 дней. Зеленым будут подсвечены объекты, которые стоит продвинуть, красным, которые были продвинуты зря.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                        Как часто собирается статистика фидов?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        Статистика за прошлый день собирается каждый день в 8 утра, так как именно в это время мы имеем статистику по каждому опубликованному объекту.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        Как часто обновляются данные по текущим фидам?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        Данные обновляются каждые пол часа, с целью мониторинга изменения ставок лидера, позиции в выдаче и других параметров зависящих от выбранной вами ставки.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Как добавить фид?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        Новый фид можно добавить в вашем личном кабинете, который открывается при нажатии на раздел фиды в боковом меню. Каждый новый добавленный фид проходит валидацию, чтобы выбранный вами xml - файл был доступен, а данный по API - циана было возможно получить.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                        Почему есть поля с нулевым ID Циана?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFive">
                    <div class="accordion-body">
                        Данные строки в таблице получаются в результате ошибочной записи в вашем xml файле, то есть запись с данных уникального ID ключа циана не является опубликованной. Это происходит в результате неправильного формирования объекта, например если при продаже квартиры вы не указали этаж, и следовательно статистику по нему невозможно получить.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                    Где взять мой API ключ Циана? 
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSix">
                    <div class="accordion-body">
                        Для получения ключа нужно написать письмо на <a href="import@cian.ru">import@cian.ru</a> с темой "ACCESS KEY" и названием агентства, которое вы представляете. Менеджер уточнит подробности и пришлет ACCESS KEY. После получения ключа, пропишите его в разделе Настройки, в поле "API ключ ЦИАН".
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false" aria-controls="panelsStayOpen-collapseSeven">
                    Какие объекты в таблицы подсвечиваются фиолетовым?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSeven">
                    <div class="accordion-body">
                        Объекты, которые на циане имеют отметку ТОП.
                    </div>  
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseNine" aria-expanded="false" aria-controls="panelsStayOpen-collapseNine">
                    Как определяется баланс и количество баллов аукциона, и как часто он обновляется?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseNine" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingNine">
                    <div class="accordion-body">
                        Баланс и баллы аукциона суммируеются по всем вашим ключам API указанных во вкладке ФИДЫ, не учитывая повторные API (если у вас к одному аккаунту, привязаны несколько фидов и вы их добавили сюда). Они обновляются раз в пол часа, как и сам ваш xml-файл, который мы вам формируем.
                    </div>  
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseEight" aria-expanded="false" aria-controls="panelsStayOpen-collapseEight">
                    Что означают иконки в самом верху страницы?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseEight" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingEight">
                    <div class="accordion-body">
                        <ul>
                            <li>
                                <i class="fas fa-clock me-1"></i> - Остаток дней, до конца подписки.
                            </li>
                            <li>
                                <i class="far fa-registered me-1"></i> - Дневной расход в рублях - сколько денег вы сегодня потратили на ставки.
                            </li>
                            <li>
                                <i class="fas fa-chess me-1"></i> - Выбранная стратегия.
                            </li>
                        </ul>   
                    </div>  
                </div>
            </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTen" aria-expanded="false" aria-controls="panelsStayOpen-collapseTen">
                            Какие объеты расположены в разделе "Ошибочные объекты"?
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTen" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTen">
                        <div class="accordion-body">
                            Объекты которые являются не опубликованными (разделе "Ошибочные объекты" в ID цина будет так и написано) по какой-либо причины указанный в стробце ошибок. Также стоит обратить внимания на предупреждения, так как они будут засорять ваш личный кабинет циана. Поэтому от них нужно своевременно избавляться. 
                        </div>  
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-heading11">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse11" aria-expanded="false" aria-controls="panelsStayOpen-collapse11">
                            Можно ли обновить фид с новыми ставками сразу, не ожидая 30 минут?
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse11" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading11">
                        <div class="accordion-body">
                            Такая возможность есть в разделе ФИДЫ, при нажатии на кнопку редактирования нужного вам фида, есть кнопка обновить сейчас. Нажав на нее ранее выданный вам фид будет обновлен.
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection