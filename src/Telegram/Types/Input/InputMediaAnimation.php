<?php

namespace SergiX44\Nutgram\Telegram\Types\Input;

use JsonSerializable;
use SergiX44\Hydrator\Annotation\ArrayType;
use SergiX44\Hydrator\Annotation\SkipConstructor;
use SergiX44\Hydrator\Resolver\EnumOrScalar;
use SergiX44\Nutgram\Telegram\Properties\InputMediaType;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Internal\InputFile;
use SergiX44\Nutgram\Telegram\Types\Message\MessageEntity;
use function SergiX44\Nutgram\Support\array_filter_null;

/**
 * Represents an animation file (GIF or H.264/MPEG-4 AVC video without sound) to be sent.
 * @see https://core.telegram.org/bots/api#inputmediaanimation
 */
#[SkipConstructor]
class InputMediaAnimation extends InputMedia implements JsonSerializable
{
    /** Type of the result, must be animation */
    #[EnumOrScalar]
    public InputMediaType|string $type = InputMediaType::ANIMATION;

    /**
     * Optional.
     * Thumbnail of the file sent;
     * can be ignored if thumbnail generation for the file is supported server-side.
     * The thumbnail should be in JPEG format and less than 200 kB in size.
     * A thumbnail's width and height should not exceed 320.
     * Ignored if the file is not uploaded using multipart/form-data.
     * Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
     * {@see https://core.telegram.org/bots/api#sending-files More information on Sending Files »}
     */
    public InputFile|string|null $thumbnail = null;

    /**
     * Optional.
     * Caption of the animation to be sent, 0-1024 characters after entities parsing
     */
    public ?string $caption = null;

    /**
     * Optional.
     * Mode for parsing entities in the animation caption.
     * See {@see https://core.telegram.org/bots/api#formatting-options formatting options} for more details.
     */
    #[EnumOrScalar]
    public ParseMode|string|null $parse_mode = null;

    /**
     * Optional.
     * List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @var MessageEntity[] $caption_entities
     */
    #[ArrayType(MessageEntity::class)]
    public ?array $caption_entities = null;

    /**
     * Optional. True, if the caption must be shown above the message media
     */
    public ?bool $show_caption_above_media = null;

    /**
     * Optional.
     * Animation width
     */
    public ?int $width = null;

    /**
     * Optional.
     * Animation height
     */
    public ?int $height = null;

    /**
     * Optional.
     * Animation duration in seconds
     */
    public ?int $duration = null;

    /**
     * Optional.
     * Pass True if the animation needs to be covered with a spoiler animation
     */
    public ?bool $has_spoiler = null;

    public function __construct(
        InputFile|string $media,
        InputFile|string|null $thumbnail = null,
        ?string $caption = null,
        ParseMode|string|null $parse_mode = null,
        ?array $caption_entities = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null,
        ?bool $has_spoiler = null,
        ?bool $show_caption_above_media = null,
    ) {
        parent::__construct();
        $this->media = $media;
        $this->thumbnail = $thumbnail;
        $this->caption = $caption;
        $this->parse_mode = $parse_mode;
        $this->caption_entities = $caption_entities;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->has_spoiler = $has_spoiler;
        $this->show_caption_above_media = $show_caption_above_media;
    }

    public static function make(
        InputFile|string $media,
        InputFile|string|null $thumbnail = null,
        ?string $caption = null,
        ParseMode|string|null $parse_mode = null,
        ?array $caption_entities = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null,
        ?bool $has_spoiler = null,
        ?bool $show_caption_above_media = null,
    ): self {
        return new self(
            media: $media,
            thumbnail: $thumbnail,
            caption: $caption,
            parse_mode: $parse_mode,
            caption_entities: $caption_entities,
            width: $width,
            height: $height,
            duration: $duration,
            has_spoiler: $has_spoiler,
            show_caption_above_media: $show_caption_above_media,
        );
    }

    public function jsonSerialize(): array
    {
        return array_filter_null([
            'type' => $this->type,
            'media' => $this->media,
            'thumbnail' => $this->thumbnail,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'show_caption_above_media' => $this->show_caption_above_media,
            'width' => $this->width,
            'height' => $this->height,
            'duration' => $this->duration,
            'has_spoiler' => $this->has_spoiler,
        ]);
    }
}
