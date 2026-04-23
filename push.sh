#!/bin/bash

# Script de Envío (Push) - Academia Buenfil
# Ubicación: /var/www/academia/push.sh

echo "🚀 Iniciando proceso de envío a GitHub..."

# 1. Agregar cambios
git add .

# 2. Solicitar mensaje de commit
echo "📝 Introduce el mensaje para este cambio (ej. 'Mejora de notificaciones'):"
read commit_message

if [ -z "$commit_message" ]; then
    commit_message="Actualización automática $(date +'%Y-%m-%d %H:%M')"
fi

# 3. Commit y Push
git commit -m "$commit_message"
git push origin main

echo "✅ Cambios subidos correctamente a GitHub."
