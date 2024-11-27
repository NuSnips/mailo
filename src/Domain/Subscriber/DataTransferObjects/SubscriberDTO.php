<?php

namespace Domain\Subscriber\DataTransferObjects;

use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class SubscriberDTO extends Data
{

    public function __construct(
        public readonly ?int $id,
        public readonly string $email,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly ?Collection $tags,
        public readonly ?FormDTO $form

    ) {}

    public static function rules($context)
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('subscribers', 'email')->ignore(request('subscriber')),
            ],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],


        ];
    }

    public static function messages(...$args)
    {
        return [
            'form_id.required' => 'The form field is required.',
            'tag_ids.required' => 'The tag(s) field is required.',
        ];
    }

    public static function fromRequest(Request $request)
    {

        return self::from([
            ...$request->all(),
            'tags' => TagDTO::collect(
                Tag::whereIn('id', $request->collect('tag_ids') ?? [])->get()
            ),
            'form' => FormDTO::from(Form::findOrNew($request->form_id))
        ]);
    }
}
