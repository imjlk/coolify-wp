#!/bin/bash

# Build script for Coolify deployment
set -e

echo "Building WordPress development template..."

# Install Node.js dependencies if package.json exists
if [ -f "package.json" ]; then
    echo "Installing Node.js dependencies..."
    npm ci --production=false
fi

# Build theme assets
if [ -d "wp-content/themes/custom" ]; then
    echo "Building theme assets..."
    cd wp-content/themes/custom
    if [ -f "package.json" ]; then
        npm ci --production=false
        npm run build
    fi
    cd ../../../
fi

# Build plugin assets
if [ -d "wp-content/plugins/custom-blocks" ]; then
    echo "Building plugin assets..."
    cd wp-content/plugins/custom-blocks
    if [ -f "package.json" ]; then
        npm ci --production=false
        npm run build
    fi
    cd ../../../
fi

echo "Build completed successfully!"