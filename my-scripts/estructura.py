import os
from pathlib import Path

# Carpeta y archivos a excluir (core WP, .git, .vscode)
EXCLUIR = [
    "wp-admin", "wp-includes", ".git", ".vscode",
    "wp-activate.php", "wp-blog-header.php", "wp-comments-post.php", "wp-config-sample.php",
    "wp-config.php", "wp-links-opml.php", "wp-load.php", "wp-login.php", "wp-mail.php",
    "wp-settings.php", "wp-signup.php", "wp-trackback.php", "xmlrpc.php", "index.php", "readme.html",
    ".htaccess", "license.txt"
    # Puedes agregar más archivos core si quieres excluirlos del árbol
]

def es_core(nombre):
    """Verifica si la carpeta o archivo debe ser excluido por ser core de WP o sistema."""
    return nombre in EXCLUIR

def guardar_estructura(ruta_raiz):
    estructura = []

    for root, dirs, files in os.walk(ruta_raiz):
        carpeta_relativa = os.path.relpath(root, ruta_raiz)
        carpeta_nombre = os.path.basename(root)
        # Excluir carpetas no deseadas
        if carpeta_nombre in EXCLUIR:
            dirs[:] = []
            continue

        nivel = carpeta_relativa.count(os.sep) if carpeta_relativa != '.' else 0
        indentacion = '|' + '____' * nivel
        estructura.append(f"{indentacion}{carpeta_nombre}/")
        sub_indentacion = '|' + '____' * (nivel + 1)

        # Archivos de la carpeta (sin los core/ocultos)
        for f in files:
            if not es_core(f):
                estructura.append(f"{sub_indentacion}{f}")

        # Eliminar de dirs cualquier subcarpeta excluida para que os.walk no las explore
        dirs[:] = [d for d in dirs if d not in EXCLUIR]

    salida = "\n".join(estructura)
    archivo_salida = Path(ruta_raiz) / "estructura.txt"
    with open(archivo_salida, "w", encoding="utf-8") as f:
        f.write(salida)

if __name__ == "__main__":
    ruta_objetivo = Path(__file__).resolve().parents[1]
    guardar_estructura(ruta_objetivo)
