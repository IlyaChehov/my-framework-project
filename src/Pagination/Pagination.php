<?php

namespace Ilya\MyFrameworkProject\Pagination;

class Pagination
{
    private int $countPages; // Общее количество страниц
    private int $currentPage; // текущая страница
    private string $uri; // УРЛ

    public function __construct(
        private int $totalRecords = 1, // Общее количество записей айтемов
        private int $perPage = PAGINATION_SETTINGS['perPage'], // сколько записей выводим на страницу
        private int $midSize = PAGINATION_SETTINGS['midSize'], // справа и слева количество ссылок / страниц
        private int $maxPages = PAGINATION_SETTINGS['maxPages'], // Макс кол-во страниц для вывода страниц / ссылок
        private string $tpl = PAGINATION_SETTINGS['tpl'] // Шаблон
    )
    {
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage();
        $this->uri = $this->getParams();
        $this->midSize = $this->getMidSize();
    }

    private function getCountPages(): int
    {
        return (int)ceil($this->totalRecords / $this->perPage) ?: 1; //считаем кол-во страниц
    }

    private function getCurrentPage(): int
    {
        $page = (int)request()->get('page', 1);
        if ($page < 1 || $page > $this->countPages) {
            abort('404 - Page not found');
        }

        return $page;
    }

    private function getParams(): string
    {
        $url = request()->getUri();
        $url = parse_url($url);
        $uri = $url['path'];

        if (!empty($url['query']) && $url['query'] !== '&') {
            parse_str($url['query'], $params);
            if (isset($params['page'])) {
                unset($params['page']); // удаляем page чтобы потом его приклеить
            }

            if (!empty($params)) {
                $uri .= '?' . http_build_query($params);
            }
        }

        return $uri;
    }

    private function getMidSize(): int
    {
        return ($this->countPages <= $this->maxPages) ? $this->countPages : $this->midSize;
        //Если у нас общее количество страниц меньше или равно мах Пейдж тогда используем общее количество страниц иначе мид сайз
    }

    public function getOffset(): int
    {
        return ($this->currentPage - 1) * $this->perPage; // с какой позиции забирать данные из БД
        // 1 первая страница = (1 - 1) * 3 = 0   0-3 запись тк перПейд = 3
        // 2 страница = (2 - 1) * 3 = 3
        // 3 страница = (3 - 1) * 3 = 6
    }

    public function getHtml()
    {
        $back = ''; // назад
        $forward = ''; // вперед
        $firstPage = ''; // первая страничка
        $lastPage = ''; // последняя страничка
        $pagesLeft = []; // странички слева
        $pagesRight = []; // странички справа
        $currentPage = $this->currentPage; // текущая

        if ($this->currentPage > 1) { // если текущая страница НЕ ПЕРВАЯ, а больше первой тогда показывает back
            $back = $this->getLink($this->currentPage - 1);
        }

        if ($this->currentPage < $this->countPages) { // если текущая страница меньше чем общее количество страниц
            $forward = $this->getLink($this->currentPage + 1);
        }

        if ($this->currentPage > $this->midSize + 1) { // если текущая страница больше чем слева + 1
            $firstPage = $this->getLink(1);
        }

        if ($this->currentPage < ($this->countPages - $this->midSize)) { // если текущая страница меньше чем справа - макс страниц
            $lastPage = $this->getLink($this->countPages);
        }

        for ($i = $this->midSize; $i > 0; $i--) {
            if (($this->currentPage - $i) > 0) {
                $pagesLeft[] = [
                    'link' => $this->getLink($this->currentPage - $i),
                    'number' => $this->currentPage - $i
                ];
            }
        }

        for ($i = 1; $i <= $this->midSize; $i++) {
            if (($this->currentPage + $i) <= $this->countPages) {
                $pagesRight[] = [
                    'link' => $this->getLink($this->currentPage + $i),
                    'number' => $this->currentPage + $i
                ];
            }
        }

        return view()->renderPartial($this->tpl, compact('back', 'forward', 'firstPage', 'lastPage', 'pagesLeft', 'pagesRight', 'currentPage'));
    }

    private function getLink($page): string
    {
        if ($page === 1) {
            return rtrim($this->uri, '?&');
        }

        if (str_contains($this->uri, '&') || str_contains($this->uri, '?')) {
            return "{$this->uri}&page={$page}";
        } else {
            return "{$this->uri}?page={$page}";
        }
    }

    public function __toString(): string
    {
        return $this->getHtml();
    }
}
