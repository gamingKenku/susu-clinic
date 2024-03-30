<div class="d-flex flex-row align-items-center mt-3 mb-3">
    <label class="me-3 align-middle" for="filter">Фильтр таблицы</label>
    <input type="text" name="filter" id="filter" class="form-control w-25 me-3" value="{{ Request::input('filter') }}" placeholder="Введите фильтр...">
    <button type="button" name="filter-btn" id="filter-btn" class="btn btn-primary me-3">Обновить</button>
    <button type="button" name="clear-filter-btn" id="clear-filter-btn" class="btn btn-primary me-3">Сбросить</button>
</div>