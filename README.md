## Install

```shell
composer require helbing/laravel-toolkit
```

## Useage

```php
use LaravelToolkit\Traits\Response;

class Controller 
{
    use Response;

    public function index()
    {
        $data = [];

        return $this->response($data);
    }

    public function paginate()
    {
        $data = Model::paginate();

        return $this->paginate($data);
    }
}
```
