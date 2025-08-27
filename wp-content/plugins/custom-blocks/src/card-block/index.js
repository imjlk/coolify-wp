/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Register Card Block
 */
registerBlockType('custom/card-block', {
    title: __('Card Block', 'custom-blocks'),
    icon: 'id-alt',
    category: 'layout',
    attributes: {
        title: {
            type: 'string',
            source: 'html',
            selector: 'h3',
        },
        content: {
            type: 'string',
            source: 'html',
            selector: 'p',
        },
        image: {
            type: 'object',
            default: null,
        },
        linkUrl: {
            type: 'string',
            default: '',
        },
        linkText: {
            type: 'string',
            default: 'Learn More',
        },
    },
    
    edit: ({ attributes, setAttributes }) => {
        const blockProps = useBlockProps();
        const { title, content, image, linkUrl, linkText } = attributes;
        
        return (
            <div {...blockProps} className="card-block-editor">
                <MediaUploadCheck>
                    <MediaUpload
                        onSelect={(media) => setAttributes({ image: media })}
                        allowedTypes={['image']}
                        render={({ open }) => (
                            <div className="card-image">
                                {image ? (
                                    <img src={image.url} alt="" />
                                ) : (
                                    <Button onClick={open} variant="secondary">
                                        {__('Select Image', 'custom-blocks')}
                                    </Button>
                                )}
                            </div>
                        )}
                    />
                </MediaUploadCheck>
                
                <div className="card-content">
                    <RichText
                        tagName="h3"
                        placeholder={__('Card Title...', 'custom-blocks')}
                        value={title}
                        onChange={(value) => setAttributes({ title: value })}
                    />
                    <RichText
                        tagName="p"
                        placeholder={__('Card content...', 'custom-blocks')}
                        value={content}
                        onChange={(value) => setAttributes({ content: value })}
                    />
                    <RichText
                        tagName="span"
                        placeholder={__('Link text...', 'custom-blocks')}
                        value={linkText}
                        onChange={(value) => setAttributes({ linkText: value })}
                    />
                </div>
            </div>
        );
    },
    
    save: ({ attributes }) => {
        const blockProps = useBlockProps.save();
        const { title, content, image, linkUrl, linkText } = attributes;
        
        return (
            <div {...blockProps} className="card-block">
                {image && (
                    <div className="card-image">
                        <img src={image.url} alt={image.alt} />
                    </div>
                )}
                <div className="card-content">
                    <RichText.Content tagName="h3" value={title} />
                    <RichText.Content tagName="p" value={content} />
                    {linkUrl && (
                        <a href={linkUrl} className="card-link">
                            <RichText.Content tagName="span" value={linkText} />
                        </a>
                    )}
                </div>
            </div>
        );
    },
});