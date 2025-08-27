/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Register Hero Block
 */
registerBlockType('custom/hero-block', {
    title: __('Hero Block', 'custom-blocks'),
    icon: 'format-image',
    category: 'layout',
    attributes: {
        title: {
            type: 'string',
            source: 'html',
            selector: 'h1',
        },
        subtitle: {
            type: 'string',
            source: 'html',
            selector: 'p',
        },
        backgroundImage: {
            type: 'object',
            default: null,
        },
    },
    
    edit: ({ attributes, setAttributes }) => {
        const blockProps = useBlockProps();
        const { title, subtitle, backgroundImage } = attributes;
        
        return (
            <div {...blockProps} className="hero-block-editor">
                <MediaUploadCheck>
                    <MediaUpload
                        onSelect={(media) => setAttributes({ backgroundImage: media })}
                        allowedTypes={['image']}
                        render={({ open }) => (
                            <div className="hero-background">
                                {backgroundImage ? (
                                    <img src={backgroundImage.url} alt="" />
                                ) : (
                                    <Button onClick={open} variant="secondary">
                                        {__('Select Background Image', 'custom-blocks')}
                                    </Button>
                                )}
                            </div>
                        )}
                    />
                </MediaUploadCheck>
                
                <div className="hero-content">
                    <RichText
                        tagName="h1"
                        placeholder={__('Hero Title...', 'custom-blocks')}
                        value={title}
                        onChange={(value) => setAttributes({ title: value })}
                    />
                    <RichText
                        tagName="p"
                        placeholder={__('Hero subtitle...', 'custom-blocks')}
                        value={subtitle}
                        onChange={(value) => setAttributes({ subtitle: value })}
                    />
                </div>
            </div>
        );
    },
    
    save: ({ attributes }) => {
        const blockProps = useBlockProps.save();
        const { title, subtitle, backgroundImage } = attributes;
        
        return (
            <div {...blockProps} className="hero-block" style={{
                backgroundImage: backgroundImage ? `url(${backgroundImage.url})` : 'none'
            }}>
                <div className="hero-content">
                    <RichText.Content tagName="h1" value={title} />
                    <RichText.Content tagName="p" value={subtitle} />
                </div>
            </div>
        );
    },
});